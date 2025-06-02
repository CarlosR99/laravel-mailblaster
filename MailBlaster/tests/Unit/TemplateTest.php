<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Template;
use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemplateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_habilitarse_y_deshabilitarse()
    {
        $template = Template::factory()->create(['active' => false]);
        $template->active = true;
        $template->save();

        $this->assertTrue($template->fresh()->active);

        $template->active = false;
        $template->save();

        $this->assertFalse($template->fresh()->active);
    }

    /** @test */
    public function relacion_con_campanas_funciona()
    {
        $template = Template::factory()->create();
        $campaign = Campaign::factory()->create(['template_id' => $template->id]);

        $this->assertTrue($template->campaigns->contains($campaign));
    }
}
