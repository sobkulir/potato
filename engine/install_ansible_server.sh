#!/usr/bin/env bash

ansible --version

# Install ansible if not installed  (exit status != 0)
if [ $? -ne 0 ]; then
     apt-get update
     apt-get install -y software-properties-common
     apt-add-repository --yes --update ppa:ansible/ansible
     apt-get install -y ansible
     apt-get install -y sshpass
    ansible --version
    if [ $? -ne 0 ]; then
       echo "Unable to install Ansible"
       exit $ERRORCODE    
    fi
fi

# Remove repository -> to enable apt-get update 
apt-add-repository --remove -y ppa:ansible/ansible

# If needed execute server setup
DIR=/var/www/html/secmon/AtomicTesting
mkdir -p $DIR
if [ $(ls -A $DIR | wc -l) == 0 ]; then     
     # sed -i 's/#host_key_checking/host_key_checking/' /etc/ansible/ansible.cfg
     ansible-playbook /var/www/html/engine/pastebins/server_setup_noVM.yaml
fi
