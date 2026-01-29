<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;

class CategoryCrudTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_index(): void
    {
        $categories = Category::factory(10)->create();

        $response = $this->actingAs($this->user)->get(route('categories.index'));

        $response->assertViewIs('admin.categories.index');
        $response->assertViewHas('categories');

        $categories->each(function ($category) use ($response) {
            $response->assertSee($category->name);
        });

        $response->assertStatus(200);
    }

    public function test_create_page_returns_success(): void
    {
        $response = $this->actingAs($this->user)->get(route('categories.create'));

        $response->assertStatus(200);
    }

    public function test_store_creates_category(): void
    {
        $data = [
            'name' => 'Nouvelle Catégorie',
            'description' => 'Description de la catégorie'
        ];

        $response = $this->actingAs($this->user)->post(route('categories.store'), $data);

        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', [
            'name' => 'Nouvelle Catégorie',
            'slug' => 'nouvelle-categorie',
            'description' => 'Description de la catégorie'
        ]);
    }

    public function test_edit_page_returns_success(): void
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->user)->get(route('categories.edit', $category));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.edit');
        $response->assertViewHas('category', $category);
    }

    public function test_update_modifies_category(): void
    {
        $category = Category::factory()->create([
            'name' => 'Ancienne Catégorie',
            'description' => 'Ancienne description',
            'slug' => 'ancienne-categorie'
        ]);

        $updatedData = [
            'name' => 'Catégorie Modifiée',
            'description' => 'Modifiée description',
        ];

        $response = $this->actingAs($this->user)->put(route('categories.update', $category), $updatedData);

        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Catégorie Modifiée',
            'description' => 'Modifiée description'
        ]);
    }

    public function test_destroy_soft_deletes_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('categories.destroy', $category));

        $response->assertRedirect(route('categories.index'));
        $this->assertSoftDeleted('categories', ['id' => $category->id]);
    }

    public function test_archived_page_returns_success(): void
    {
        $response = $this->actingAs($this->user)->get(route('categories.archived'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.archived');
    }

    public function test_restore_brings_back_soft_deleted_category(): void
    {
        $category = Category::factory()->create();
        $category->delete(); // Soft delete it first

        $response = $this->actingAs($this->user)->patch(route('categories.restore', $category));

        $response->assertRedirect(route('categories.archived'));
        $this->assertDatabaseHas('categories', ['id' => $category->id]);
        $this->assertFalse($category->fresh()->trashed());
    }

    public function test_force_delete_removes_category(): void
    {
        $category = Category::factory()->create();
        $category->delete(); // Soft delete it first

        $response = $this->actingAs($this->user)->delete(route('categories.force-delete', $category));

        $response->assertRedirect(route('categories.archived'));
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_validation_errors_on_store(): void
    {
        $data = [
            'name' => '', // Nom requis
            'description' => ''
        ];

        $response = $this->actingAs($this->user)->post(route('categories.store'), $data);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_validation_errors_on_update(): void
    {
        $category = Category::factory()->create();
        $data = [
            'name' => '', // Nom requis
            'description' => ''
        ];

        $response = $this->actingAs($this->user)->put(route('categories.update', $category), $data);

        $response->assertSessionHasErrors(['name']);
    }
}
