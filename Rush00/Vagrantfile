Vagrant.configure("2") do |config|
	config.vm.provider "virtualbox" do |vb|
		vb.memory = "2048"
		vb.cpus = "2"
	end
	config.vm.box = "debian/stretch64"
	config.vm.synced_folder ".", "/git"
	config.vm.provision :shell, path: "install.sh"
	config.vm.network "forwarded_port", guest: 8100, host: 8100
	config.vm.network "forwarded_port", guest: 3306, host: 3306
end
