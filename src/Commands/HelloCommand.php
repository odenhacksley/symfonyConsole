<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

//Команда
class HelloCommand extends Command
{
    protected static $defaultName = 'sayHello ';

    public static function output()
    {
        return 'im Alive';
    }

    protected function configure(): void
    {   //Description and help
        $this->setDescription('Says hello');

        //Required input parameter
        $this->addArgument
        (
            'objectToGreet',
            InputArgument::REQUIRED,
            'Object to say hello'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $objectToGreet = $input->getArgument('objectToGreet');
            if (empty($objectToGreet)) {
                throw new InvalidArgumentException();
            }
            $output->writeln('Привет ' . $objectToGreet);
            return self::SUCCESS;
        } catch (InvalidArgumentException $e) {
            $output->writeln('Вы ввели пустую строку, попробуйте еще раз',);
            return self::FAILURE;
        }
    }
}

