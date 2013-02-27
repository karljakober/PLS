Vagrant::Config.run do |config|
  config.vm.define :pl do |pl_config|
    pl_config.vm.box = "lucid32"
    pl_config.vm.box_url = "http://files.vagrantup.com/lucid32.box"
    pl_config.vm.network :hostonly, "33.33.33.10"
    pl_config.vm.forward_port 80, 8080
  end
end
