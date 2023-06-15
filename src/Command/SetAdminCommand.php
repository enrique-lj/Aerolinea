<?php 

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;




#[AsCommand(
    name: 'app:user:set-roles',
    description: 'Creates a new user.',
    hidden: false,
    aliases: ['app:user:set-roles']
)]
class SetAdminCommand extends Command
{
    
    public function __construct(private UserRepository $userRepository)
    {
        parent::__construct();

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = $this->userRepository->findOneByEmail('usuario@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $this->userRepository->save($user,true);
        return Command::SUCCESS;
    }

    
}

?>