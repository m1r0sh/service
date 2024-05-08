<?php

namespace Tests\Feature\Note;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Note;
use Tests\TestCase;

class NoteTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_notes_can_be_list(): void
    {
        $response = $this->get('/v1/notes/list');
        $response->assertStatus(200);
    }
    public function test_notes_can_be_show(): void
    {
        $note = Note::factory()->create();

        $response = $this->get('/v1/notes/' . $note->getKey());
        $response->assertStatus(200);
    }

    public function test_notes_can_be_create(): void
    {
        $data = [
            'title' => 'Test title',
            'content' => 'Test content',
            'status' => true,
        ];

        $response = $this->get('/v1/notes/add', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('notes', $data);
    }

    public function test_notes_can_be_update(): void
    {
        $note = Note::factory()->create();
        $data = [
            'title' => 'Test title update',
            'content' => 'Test content update',
            'status' => false,
        ];

        $response = $this->get('/v1/notes/' . $note->getKey(), $data);
        $response->assertStatus(202);

        $this->assertDatabaseHas('notes', array_merge(['id' => $note->getKey()], $data));
    }

    public function test_notes_can_be_delete(): void
    {
        $note = Note::factory()->create();

        $response = $this->get('/v1/notes/' . $note->getKey());
        $response->assertStatus(202);

        $this->assertDatabaseMissing('notes', ['id' => $note->getKey()]);
    }
}
