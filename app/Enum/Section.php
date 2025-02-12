<?php

namespace App\Enum;

enum Section: string
{
    case HERO_SECTION = 'hero_section';
    case WHY_CHOOSE_US = 'why_choose_us';

    case WORKS_STEP_1 = 'works_step_1';
    case WORKS_STEP_2 = 'works_step_2';
    case WORKS_STEP_3 = 'works_step_3';
    case WORKS_STEP_4 = 'works_step_4';

    case PROCESS_1 = 'process_1';
    case PROCESS_2 = 'process_2';
    case PROCESS_3 = 'PROCESS_3';
    case PROCESS_FINAL = 'PROCESS_FINAL';

    case WHY_CHOOSE_ITEMS = 'WHY_CHOOSE_ITEMS';


    case ABOUT_US = 'ABOUT_US';

    case OUR_STORY = 'OUR_STORY';

    case OUR_MISSION = 'OUR_MISSION';

    case OUR_VISION = 'OUR_VISION';

    case What_WE_Offer = 'What_WE_Offer';


    case CUSTOM_PACKAGE = 'custom_package';
    case STOCK_OPTION = 'stock_option';
    case SUSTAINABLE_CHOICE = 'sustainable_choice';

    public static function getHome()
    {
        return [
            self::HERO_SECTION->value => ['item' => 1, 'type' => 'first'],
            self::WHY_CHOOSE_US->value => ['item' => 1, 'type' => 'first'],
            self::WORKS_STEP_1->value => ['item' => 1, 'type' => 'first'],
            self::WORKS_STEP_2->value => ['item' => 1, 'type' => 'first'],
            self::WORKS_STEP_3->value => ['item' => 1, 'type' => 'first'],
            self::WORKS_STEP_4->value => ['item' => 1, 'type' => 'first'],
            self::ABOUT_US->value => ['item' => 1, 'type' => 'first'],
            self::OUR_STORY->value => ['item' => 1, 'type' => 'first'],
            self::OUR_MISSION->value => ['item' => 1, 'type' => 'first'],
            self::OUR_VISION->value => ['item' => 1, 'type' => 'first'],

            self::What_WE_Offer->value => ['item' => 1, 'type' => 'first'],

            self::CUSTOM_PACKAGE->value => ['item' => 1, 'type' => 'first'],
            self::STOCK_OPTION->value => ['item' => 1, 'type' => 'first'],
            self::SUSTAINABLE_CHOICE->value => ['item' => 1, 'type' => 'first'],
        ];
    }
}
