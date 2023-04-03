#!/usr/bin/env bash

ansible --version

# Install ansible if not installed  (exit status != 0)
if [ $? -ne 0 ]; then
     yum -y update
     yum -y install epel-repo
     yum -y install ansible
     yum -y install sshpass
    ansible --version
    if [ $? -ne 0 ]; then
       echo "Unable to install Ansible"
       exit $ERRORCODE    
    fi
fi

# If needed execute server setup
DIR=/var/www/html/secmon/AtomicTesting
mkdir -p $DIR
if [ $(ls -A $DIR | wc -l) == 0 ]; then
     sed -i 's/#host_key_checking/host_key_checking/' /etc/ansible/ansible.cfg
     ansible-playbook /var/www/html/engine/pastebins/server_setup_noVM.yaml
fi 



    
#fi



