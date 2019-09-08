

application/command.php  
中添加执行command的路径（psr4）--驼峰命名

php think demo:command_01

class DemoCommand {

    protected function configure()
        {
            $this->setName('demo:command_01')->setDescription('demo-command_01');
        }
    }
    
    protected function execute(Input $input, Output $output)
    {
        $output->writeln(date('Y-m-d H:i:s')." demo-command start");
        $output->writeln(date('Y-m-d H:i:s')." demo-command start");
    }
}
 
