<?php

use Illuminate\Database\Seeder;
use App\Project;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = new Project;
        $project->code = 'PR0545';
        $project->title = 'Wordpress landing page';
        $project->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vehicula nulla id tempor dapibus. Nam placerat convallis mattis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris condimentum, orci a euismod eleifend, risus velit efficitur metus, eu pharetra lorem orci nec magna. Donec ac lorem varius, vestibulum lacus sed, egestas sapien. Phasellus efficitur id dui lacinia aliquet. ';
        $project->status = 'open';
        $project->start_date = '2018-02-08';
        $project->end_date = '2018-06-21';
        $project->save();
        $project->users()->attach([1, 3]);

        $project = new Project;
        $project->code = 'PR2698';
        $project->title = 'Bootstrap UX Design';
        $project->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vehicula nulla id tempor dapibus. Nam placerat convallis mattis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris condimentum, orci a euismod eleifend, risus velit efficitur metus, eu pharetra lorem orci nec magna. Donec ac lorem varius, vestibulum lacus sed, egestas sapien. Phasellus efficitur id dui lacinia aliquet. ';
        $project->status = 'completed';
        $project->start_date = '2018-03-30';
        $project->end_date = '2018-09-15';
        $project->save();
        $project->users()->attach([2, 4, 5]);
    }
}
