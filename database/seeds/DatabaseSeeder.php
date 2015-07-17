<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Role;
use App\Permission;
use App\Tag;
use App\Job;
use App\Rating;
use App\Bid;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //factory(App\User::class, 20)->create();
        //DB::table('users')->delete();

        $name = str_replace('.','','Manager');
        User::create([
            'name' => $name,
            'email' => 'manager@me.com',
            'description' => 'Worked in the Computer Science industry for 8 years. I am highly skilled in Java, PHP, CSS and HTML. Currently managing the website creation unit in A12.',
            'password' => bcrypt('manager'),
        ]);
        
        $name2 = str_replace('.','','Manager2');
        User::create([
            'name' => $name2,
            'email' => 'manager2@me.com',
            'description' => 'Highly skilled in HTML and PHP. Currently in charge of group A14 in the subject of website creation/design.',
            'password' => bcrypt('manager2'),
        ]);
        
        $name3 = str_replace('.','','Test');
        User::create([
            'name' => $name3,
            'email' => 'test123@me.com',
            'description' => 'Studied computer science at Oxford university. Highly skilled in HTML and CSS. Little knowledge of PHP. Enjoy web design/creation and creating programs that can be reused for many purposes.',
            'password' => bcrypt('test123'),
        ]);
        
        $name4 = str_replace('.','','Casey Denner');
        User::create([
            'name' => $name4,
            'email' => 'caseylouisee@me.com',
            'description' => 'Second year student at Swansea University, studying towards an MEng in Computer Science. Knowledge of HTML and PHP and skilled in Java. To see work from my portfolio please do not hesitate to message me.',
            'password' => bcrypt('caseylouisee'),
        ]);
        
        $name5 = str_replace('.','','Joe Bloggs');
        User::create([
            'name' => $name5,
            'email' => 'joebloggs@me.com',
            'description' => 'I mainly work on REST web services however I have created many IOS applications both for leisure and as work tasks.',
            'password' => bcrypt('joebloggs'),
        ]);
        
        Tag::create([
            'name' => 'HTML',
        ]);
            
        Tag::create([
            'name' => 'CSS',
        ]);
        
        Tag::create([
            'name' => 'PHP',
        ]);
        
        Tag::create([
        'name' => 'Java',
        ]);
        
        $jobtitle = str_replace('.','','Data entry');
       // $jobslug = str_replace(' ','-',strtolower($jobtitle));
        Job::create([
            'title' => $jobtitle,
            'description' => '100 entries need to be typed into an excel spreadsheet and then formatted to fit as many entries on a piece of A4 as possible when printed. ',
            'bidding' => 'Closed',
            'status' => 'Completed',
        ]);
        
        $jobtitle2 = str_replace('.','','Small calculator program');
        Job::create([
            'title' => $jobtitle2,
            'description' => 'The programme needs to include the basic functions - addition, subtraction, multiplication and division.',
            'bidding' => 'Closed',
        ]);
        
        $jobtitle3 = str_replace('.','','Proof read an article');
        Job::create([
            'title' => $jobtitle3,
            'description' => 'The article to be proof read is about social media and its impact in the world. Social media is a big part of our lives now and this article studies in depth the benefits and disadvantages of it.',
        ]);
        
        Rating::create([
            'rating' => 5,
            'comment' => 'Project completed to a high standard and delivered on time. Excellent workmanship. Code is also fully commented to increase future readability. Highly recommend.',
        ]);
        
        Rating::create([
            'rating' => 4,
            'comment' => 'Project was completed to a high standard but unfortunately was not delivered at time specified. However I would recommend this user.',
        ]);
        
        $manager = new Role();
        $manager->name         = 'Manager';
        $manager->display_name = 'Manager'; // optional
        $manager->description  = 'User is a manager.'; // optional
        $manager->save();

        $developer = new Role();
        $developer->name         = 'Developer';
        $developer->display_name = 'Developer'; // optional
        $developer->description  = 'User is a developer.'; // optional
        $developer->save();
        
        Bid::create([
            'user_id'=>3,
            'job_id'=>1,
            'proposal'=>'£30 to complete by tomorrow 3pm.',
            'status' => 'Declined'
        ]);
        
        Bid::create([
            'user_id'=>4,
            'job_id'=>1,
            'proposal'=>'£50 to complete by tonight 9pm.',
            'status' => 'Accepted'
        ]);
        
        Bid::create([
            'user_id'=>5,
            'job_id'=>2,
            'proposal'=>'£100 to complete within an hour of acceptance.',
            'status' => 'Declined'
        ]);
        
        Bid::create([
            'user_id'=>3,
            'job_id'=>2,
            'proposal'=>'£30 to complete by tomorrow 4pm.',
            'status' => 'Accepted'
        ]);
        
        Bid::create([
            'user_id'=>4,
            'job_id'=>3,
            'proposal'=>'£15 to complete by tomorrow 7pm.'
        ]);
        
        Bid::create([
            'user_id'=>5,
            'job_id'=>3,
            'proposal'=>'£30 to complete by tomorrow 3pm.'
        ]);
        
        $user = User::find(1);
        $user->attachRole($manager);
        
        $user2 = User::find(2);
        $user2->attachRole($manager); 
        
        $user3 = User::find(3);
        $user3->attachRole($developer); 
        
        $user4 = User::find(4);
        $user4->attachRole($developer);
        
        $user5 = User::find(5);
        $user5->attachRole($developer);
        
        $job1 = Job::find(1);
        $job1->users()->attach($user->id);
        
        $job2 = Job::find(2);
        $job2->users()->attach($user2->id);
        $job2->users()->attach($user->id);
        
        $job3 = Job::find(3);
        $job3->users()->attach($user->id);
        
        $tag1 = Tag::find(1);
        $tag1->users()->attach($user->id);
        $tag1->users()->attach($user2->id);
        $tag1->users()->attach($user3->id);
        $tag1->users()->attach($user4->id);
        
        $tag2 = Tag::find(2);
        $tag2->users()->attach($user->id);
        $tag2->users()->attach($user2->id);
        $tag2->users()->attach($user3->id);

        $tag3 = Tag::find(3);
        $tag3->users()->attach($user->id);
        $tag3->users()->attach($user2->id);
        $tag3->users()->attach($user4->id);
        
        $tag4 = Tag::find(4);
        $tag4->users()->attach($user->id);
        $tag4->users()->attach($user4->id);
        $tag4->users()->attach($user5->id);
        
        $rating1 = Rating::find(1);
        $user3->ratings()->attach($rating1, array('rated_by' => 1));
        
        $rating2 = Rating::find(2);
        $user4->ratings()->attach($rating2, array('rated_by' => 2));

        /*
        $createJob = new Permission();
        $createJob->name         = 'create-job';
        $createJob->display_name = 'Create/Edit/Delete Job'; // optional
        $createJob->description  = 'Create/Edit/Delete jobs'; // optional
        $createJob->save();

        $manager->attachPermission($createJob);
        //equivalent to $admin->perms()->sync(array($createPost->id));
        */

        //$owner->attachPermissions(array($createPost, $editUser));
        // equivalent to $owner->perms()->sync(array($createPost->id, $editUser->id));
        // $user->hasRole('owner');   // false
        // $user->hasRole('admin');   // true
        // $user->can('edit-user');   // false
        // $user->can('create-post'); // true
        
        //$this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
