<?php
declare(strict_types=1);

namespace LoyaltyCorp\EasyCfhighlander\Tests\Console\Commands;

use LoyaltyCorp\EasyCfhighlander\Tests\AbstractTestCase;

final class CloudFormationCommandTest extends AbstractTestCase
{
    /**
     * Command should generate cloudformation files.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testGenerateCloudFormationFiles(): void
    {
        $inputs = [
            'project',
            'project.com',
            'aws_dev_account',
            '599070804856',
            'aws_prod_account'
        ];

        $files = [
            'project.cfhighlander.rb',
            'project.config.yaml',
            'project.mappings.yaml',
            'Jenkinsfile',
            'aurora.config.yaml',
            'az.mappings.yaml',
            'bastion.config.yaml',
            'loadbalancer.config.yaml',
            'redis.config.yaml',
            'sqs.config.yaml',
            'vpc.config.yaml',
            'ecs/ecs.cfhighlander.rb',
            'ecs/ecs.cfndsl.rb',
            'ecs/ecs.config.yaml'
        ];

        $display = $this->executeCommand('cloudformation', $inputs);

        foreach ($inputs as $input) {
            self::assertContains($input, $display);
        }

        self::assertContains(\sprintf('Generating files in %s:', \realpath(static::$cwd)), $display);

        foreach ($files as $file) {
            self::assertTrue($this->getFilesystem()->exists(static::$cwd . '/' . $file));
            self::assertContains($file, $display);
        }
    }
}