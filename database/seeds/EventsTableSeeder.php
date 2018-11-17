<?php

use Illuminate\Database\Seeder;
use App\{User, Event, Show, Venue, Stage, Section, Row, Seat};

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // An event without a show
        factory(Event::class)->create();
        
        // Create an event with multiple shows
        $event = factory(Event::class)->create();
        $shows = factory(Show::class, 2)->create([
            'event_id' => $event->id,
        ]);

        // Create an Stage
        $stage = factory(Stage::class)->create();
        $sections = factory(Section::class, 4)->create([
            'stage_id' => $stage->id,
        ]);
        foreach ($sections as $section) {

            // Define a price for a show-stage
            $show = $shows->random();
            $section->shows()->attach($show->id, ['price' => mt_rand(5,20)*1000]);
                
            $seats = factory(Seat::class, 30)->create([
                'section_id' => $section->id,
            ]);
            
        }


        // Reserve some seats for some users in some show
        
        $show = Show::all()->random();
        $seat = $show->sections->random()->seats->random();
        $user = User::find(1);

        $seat->shows()->attach($show->id, ['user_id' => $user->id]);
    }
}
