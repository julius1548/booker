<?php

namespace Database\Seeders;

use Bookkeeper\Booker\DataObjects\Time;
use Bookkeeper\Booker\Enums\PeriodicityType;
use Bookkeeper\Booker\Models\Availability;
use Bookkeeper\Booker\Models\AvailabilityTimeline;
use App\Domains\Restaurants\Models\Restaurant;
use App\Domains\Restaurants\Models\Table;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $availability = $this->createAvailability();

        for ($i = 0; $i < 5; $i++) {
            $restaurant = (new Restaurant())
                ->setName(fake()->firstName())
                ->setMaxOccupancy(8);
            $restaurant->save();

            for ($j = 0; $j < 4; $j++) {
                $table = (new Table())
                    ->setRestaurantId($restaurant->getId())
                    ->setMaxOccupancy($j + 1);
                $table->save();
                $table->availabilities()->attach($availability->getId());
            }
        }
    }

    private function createAvailability(): Availability
    {
        $availability = (new Availability())->setPeriodicityType(PeriodicityType::week());
        $availability->save();

        for ($i = 1; $i < 8; $i++) {
            (new AvailabilityTimeline())
                ->setAvailabilityId($availability->getId())
                ->setTimeFrom((new Time())->fromString('10:00'))
                ->setTimeTo((new Time())->fromString('20:00'))
                ->setDayNo($i)
                ->save();
        }

        return $availability;
    }
}
