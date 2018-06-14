<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class JobFixtures extends Fixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        for ($i = 100; $i <= 130; $i++) {
            $job = new Job();
            $job->setCategory($manager->merge($this->getReference('category-programming')));
            $job->setType('full-time');
            $job->setCompany('Company ' . $i);
            $job->setPosition('Web Developer');
            $job->setLocation('Paris, France');
            $job->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit.');
            $job->setHowToApply('Send your resume to lorem.ipsum [at] dolor.sit');
            $job->setPublic(true);
            $job->setActivated(true);
            $job->setToken('job_' . $i);
            $job->setEmail('job@example.com');

            $manager->persist($job);
        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder() : int
    {
        return 2;
    }
}
