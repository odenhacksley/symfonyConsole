<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ConfirmationQuestion;

//Команда Hello
class SayString extends Command
{
    protected static $defaultName = 'app:quest';
    protected $name;

    public static function output()
    {
        return 'im Alive';
    }

    protected function configure(): void
    {   //Description and help
        $this->setDescription('interactively greets you');
        /*
        $this->addArgument
        (
            'age',
            InputArgument::REQUIRED,
            'age'
        );
        $this->addArgument
        (
            'sex',
            InputArgument::REQUIRED,
            'Object for output'
        );
       */
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        /**
         * Запрос имени
         */
        $nameQuestion = new Question('Введите ваше имя:' . PHP_EOL . ">");
        $ageQuestion = new Question('Введите ваш возраст:' . PHP_EOL . ">");
        $sexQuestion = new ChoiceQuestion('Выберите пол:', ['М', 'Ж'], 0);
        do {
            $name = $this->strFormatter($helper->ask($input, $output, $nameQuestion));
            if (empty($name)) {
                $output->writeln('<error>Вы ввели пустую строку</error>');
                break;
            }
        } while (empty($name));

        do {
            $age = $this->strFormatter($helper->ask($input, $output, $ageQuestion));
            if (empty($age)) {
                $output->writeln('<error>Вы ввели пустую строку</error>');
                break;
            }
        } while (empty($age));
        $sex = $helper->ask($input, $output, $sexQuestion);
        $output->writeln(
            'Здравствуйте, ' . $name .
            ', Ваш возраст ' . $age .
            ', Ваш пол ' . $sex
        );

        /*
                $ageQuestion = new Question('Введите ваш возраст:' . PHP_EOL . ">");
                $age = $helper->ask($input, $output, $ageQuestion);


                $nameQuestion = new Question('Введите ваше имя:' . PHP_EOL . ">");
                $name = $helper->ask($input, $output, $nameQuestion);
         */
        return self::SUCCESS;
    }

    protected function strFormatter(string|null $string): string|null
    {

        return is_null($string) ? null : str_replace(['\'', "\"", ' '], '', $string);
    }
}

