RED="\[\033[0;31m\]"
YELLOW="\[\033[0;33m\]"
GREEN="\[\033[0;32m\]"
NO_COLOR="\[\033[0m\]"

parse_git_branch() {
  git branch 2> /dev/null | sed -e '/^[^*]/d' -e 's/* \(.*\)/(\1)/'
}
PS1="${debian_chroot:+($debian_chroot)}\u@\h:\w$GREEN\$(parse_git_branch)$NO_COLOR $ "

. /usr/local/bin/virtualenvwrapper.sh
