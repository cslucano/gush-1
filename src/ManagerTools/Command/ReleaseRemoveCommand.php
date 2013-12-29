<?php

/*
 * This file is part of the Manager Tools.
 *
 * (c) Luis Cordova <cordoval@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace ManagerTools\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ReleaseRemoveCommand extends BaseCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('release:delete')
            ->setDescription('Remove release')
            ->addArgument('org', InputArgument::REQUIRED, 'Name of GitHub organization')
            ->addArgument('repo', InputArgument::REQUIRED, 'Name of the GitHub repository')
            ->addArgument('id', InputArgument::REQUIRED, 'ID of the release')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = $this->getGithubClient();
        $id = $input->getArgument('id');
        $repo = $input->getArgument('repo');
        $org = $input->getArgument('org');

        $output->writeln(sprintf(
            '<info>Deleting release </info>%s<info> on </info>%s<info>/</info>%s',
            $id, $org, $repo
        ));

        $release = $client->api('repo')->releases()->remove($org, $repo, $id);
    }
}