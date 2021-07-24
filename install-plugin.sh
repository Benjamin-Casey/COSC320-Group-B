#!/bin/bash
COMMAND="sudo -u www-data wp --path=${WORDPRESS_PATH}"
echo "Installing plugins and themes"

#Append below for the plugin installation

if [ $(${COMMAND} plugin is-installed hello) ]; then
  echo "Removing Useless Plugin hello"
  ${COMMAND} plugin delete hello
fi

mv ./TWM 