#!/bin/bash
platform='unknown'
os=${OSTYPE//[0-9.-]*/}
if [[ "$os" == 'darwin' ]]; then
   platform='MAC OSX'
elif [[ "$os" == 'msys' ]]; then
   platform='window'
elif [[ "$os" == 'linux' ]]; then
   platform='linux'
fi
NORMAL="\\033[0;39m"
VERT="\\033[1;32m"
ROUGE="\\033[1;31m"
BLUE="\\033[1;34m"
ORANGE="\\033[1;33m"
echo -e "$ROUGE You are using $platform $NORMAL"
ESC_SEQ="\x1b["
COL_RESET=$ESC_SEQ"39;49;00m"
COL_RED=$ESC_SEQ"31;01m"
COL_GREEN=$ESC_SEQ"32;01m"
COL_YELLOW=$ESC_SEQ"33;01m"
COL_BLUE=$ESC_SEQ"34;01m"
COL_MAGENTA=$ESC_SEQ"35;01m"
COL_CYAN=$ESC_SEQ"36;01m"

# Linux bin paths, change this if it can not be autodetected via which command
	
if [[ "$platform" != 'window' ]]; then
	BIN="/usr/bin"
	CP="$($BIN/which cp)"
	SSH="$($BIN/which ssh)"
	CD="$($BIN/which cd)"
	GIT="$($BIN/which git)"
	ECHO="$($BIN/which echo)"
	LN="$($BIN/which ln)"
	MV="$($BIN/which mv)"
	RM="$($BIN/which rm)"
	NGINX="/etc/init.d/nginx"
	MKDIR="$($BIN/which mkdir)"
	MYSQL="$($BIN/which mysql)"
	MYSQLDUMP="$($BIN/which mysqldump)"
	CHOWN="$($BIN/which chown)"
	CHMOD="$($BIN/which chmod)"
	GZIP="$($BIN/which gzip)"
	FIND="$($BIN/which find)"
	TOUCH="$($BIN/which touch)" 
	PHP="$($BIN/which php)" 
else	
	CP="cp"
	SSH="ssh"
	CD="cd"
	GIT="git"
	ECHO="echo"
	LN="ln"
	MV="mv"
	RM="rm"
	NGINX="/etc/init.d/nginx"
	MKDIR="mkdir"
	MYSQL="mysql"
	MYSQLDUMP="mysqldump"
	#no support
	CHOWN="chown"
	CHMOD="chmod"
	GZIP="gzip"
	TOUCH="touch"
	#end no support
	FIND="find"	
	PHP="php" 
fi

### directory and file modes for cron and mirror files
FDMODE=0777
CDMODE=0700
CFMODE=600
MDMODE=0755
MFMODE=644

### 
## SOURCE="${BASH_SOURCE[0]}"
## while [ -h "$SOURCE" ]; do # resolve $SOURCE until the file is no longer a symlink
##   DIR="$( cd -P "$( dirname "$SOURCE" )" && pwd )"
##   SOURCE="$(readlink "$SOURCE")"
##   [[ $SOURCE != /* ]] && SOURCE="$DIR/$SOURCE" # if $SOURCE was a relative symlink, we need to resolve it relative to the path where the symlink file was located
## done
## DIR="$( cd -P "$( dirname "$SOURCE" )" && pwd )"
## cd $DIR
## SCRIPT_PATH=`pwd -P` # return wrong path if you are calling this script with wrong location
SCRIPT_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )" # return /path/bin
echo -e "$VERT--> Booting now ... $NORMAL"
echo -e "$VERT--> Your path: $SCRIPT_PATH $NORMAL"

# Usage info
show_help() {
cat << EOF
Usage: ${0##*/} [-hv] [-e APPLICATION_ENV] [development]...
    -h or --help         display this help and exit
    -e or --env APPLICATION_ENV
    -v or --verbose      verbose mode. Can be used multiple times for increased
                verbosity.
EOF
}
die() {
    printf '%s\n' "$1" >&2
    exit 1
}

# Initialize all the option variables.
# This ensures we are not contaminated by variables from the environment.
verbose=0
while :; do
    case $1 in
        -e|--env)
            if [ -z "$2" ]
            then
				show_help
				die 'ERROR: please specify "--e" enviroment.'
            fi
            APPLICATION_ENV="$2"
			if [[ "$2" == 'd' ]]; then
				APPLICATION_ENV="development"		
			fi	
			if [[ "$2" == 'p' ]]; then
				APPLICATION_ENV="production"		
			fi	
            shift
            break
            ;;
        -h|-\?|--help)
            show_help    # Display a usage synopsis.
            exit
            ;;
        -v|--verbose)
            verbose=$((verbose + 1))  # Each -v adds 1 to verbosity.
            ;;
        --)              # End of all options.
            shift
            break
            ;;
        -?*)
            printf 'WARN: Unknown option (ignored): %s\n' "$1" >&2
            ;;
        *)               # Default case: No more options, so break out of the loop.
            show_help    # Display a usage synopsis.
            die 'ERROR: "--env" requires a non-empty option argument.'
    esac
    shift
done

export APPLICATION_ENV="${APPLICATION_ENV}";

echo -e "$VERT--> You are uing APPLICATION_ENV: $APPLICATION_ENV $NORMAL"

## try if CMDS exist
command -v php > /dev/null || { echo "php command not found."; exit 1; }
HASCURL=1;
command -v curl > /dev/null || HASCURL=0;
if [ -z "$1" ]
    then
        DEVMODE=$1;
    else
        DEVMODE="--no-dev";
fi

### settings / options
PHPCOPTS="-d memory_limit=-1"

if [[ "$platform" != 'window' ]]; then
	$RM -rf $SCRIPT_PATH/../storage/framework/cache
	$RM -rf $SCRIPT_PATH/../storage/framework/sessions
	$RM -rf $SCRIPT_PATH/../storage/framework/testing
	$RM -rf $SCRIPT_PATH/../storage/framework/views
	$RM -rf $SCRIPT_PATH/../bootstrap/cache/*.php
	$RM -rf $SCRIPT_PATH/../composer.lock
	# $RM -Rf $SCRIPT_PATH/../storage/DoctrineModule
	# $RM -Rf $SCRIPT_PATH/../storage/DoctrineORMModule
	# $RM -Rf $SCRIPT_PATH/../storage/DoctrineMongoODMModule
else 
	$RM -rf $SCRIPT_PATH/../storage/framework/cache
	$RM -rf $SCRIPT_PATH/../storage/framework/sessions
	$RM -rf $SCRIPT_PATH/../storage/framework/testing
	$RM -rf $SCRIPT_PATH/../storage/framework/views
	$RM -rf $SCRIPT_PATH/../bootstrap/cache/*.php
	$RM -rf $SCRIPT_PATH/../composer.lock
	# $RM -rf $SCRIPT_PATH/../storage/DoctrineModule
	# $RM -rf $SCRIPT_PATH/../storage/DoctrineORMModule
	# $RM -rf $SCRIPT_PATH/../storage/DoctrineMongoODMModule
fi

# do not delete upload files
## [ ! -d "$SCRIPT_PATH/../public/uploads/media"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../public/uploads/media && touch $SCRIPT_PATH/../public/uploads/media/index.html

if [[ "$platform" != 'window' ]]; then
	[ ! -d "$SCRIPT_PATH/../storage/framework/cache"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../storage/framework/cache && touch $SCRIPT_PATH/../storage/framework/cache/index.html
	[ ! -d "$SCRIPT_PATH/../storage/framework/sessions"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../storage/framework/sessions && touch $SCRIPT_PATH/../storage/framework/sessions/index.html
	[ ! -d "$SCRIPT_PATH/../storage/framework/testing"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../storage/framework/testing && touch $SCRIPT_PATH/../storage/framework/testing/index.html
	[ ! -d "$SCRIPT_PATH/../storage/framework/views"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../storage/framework/views && touch $SCRIPT_PATH/../storage/framework/views/index.html
	[ ! -d "$SCRIPT_PATH/../storage/logs"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../storage/logs && touch $SCRIPT_PATH/../storage/logs/index.html
	[ ! -d "$SCRIPT_PATH/../bootstrap/cache"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../bootstrap/cache && touch $SCRIPT_PATH/../bootstrap/cache/index.html

	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineModule"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../storage/DoctrineModule && touch $SCRIPT_PATH/../storage/DoctrineModule/index.html
	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineORMModule"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../storage/DoctrineORMModule && touch $SCRIPT_PATH/../storage/DoctrineORMModule/index.html
	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineORMModule/Hydrator"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../storage/DoctrineORMModule/Hydrator && touch $SCRIPT_PATH/../storage/DoctrineORMModule/Hydrator/index.html
	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineORMModule/Proxy"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../storage/DoctrineORMModule/Proxy && touch $SCRIPT_PATH/../storage/DoctrineORMModule/Proxy/index.html
	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineMongoODMModule"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../storage/DoctrineMongoODMModule && touch $SCRIPT_PATH/../storage/DoctrineMongoODMModule/index.html
	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineMongoODMModule/Hydrator"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../storage/DoctrineMongoODMModule/Hydrator && touch $SCRIPT_PATH/../storage/DoctrineMongoODMModule/Hydrator/index.html
	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineMongoODMModule/Proxy"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../storage/DoctrineMongoODMModule/Proxy && touch $SCRIPT_PATH/../storage/DoctrineMongoODMModule/Proxy/index.html

	# [ ! -d "$SCRIPT_PATH/../app/Models/JmsEntity"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../app/Models/JmsEntity && touch $SCRIPT_PATH/../app/Models/JmsEntity/index.html
	## [ ! -d "$SCRIPT_PATH/../app/Models/CrmEntity"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../app/Models/CrmEntity && touch $SCRIPT_PATH/../app/Models/CrmEntity/index.html
	## [ ! -d "$SCRIPT_PATH/../app/Models/CrawlerEntity"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../app/Models/CrawlerEntity && touch $SCRIPT_PATH/../app/Models/CrawlerEntity/index.html
	## [ ! -d "$SCRIPT_PATH/../app/Models/AppDocument"  ] && $MKDIR -m $FDMODE -p $SCRIPT_PATH/../app/Models/AppDocument && touch $SCRIPT_PATH/../app/Models/AppDocument/index.html

	($CD $SCRIPT_PATH && $FIND $SCRIPT_PATH -type d -exec touch {}/index.html \; )
else
	[ ! -d "$SCRIPT_PATH/../storage/framework/cache"  ] && $MKDIR -p $SCRIPT_PATH/../storage/framework/cache && touch $SCRIPT_PATH/../storage/framework/cache/index.html
	[ ! -d "$SCRIPT_PATH/../storage/framework/sessions"  ] && $MKDIR -p $SCRIPT_PATH/../storage/framework/sessions && touch $SCRIPT_PATH/../storage/framework/sessions/index.html
	[ ! -d "$SCRIPT_PATH/../storage/framework/testing"  ] && $MKDIR -p $SCRIPT_PATH/../storage/framework/testing && touch $SCRIPT_PATH/../storage/framework/testing/index.html
	[ ! -d "$SCRIPT_PATH/../storage/framework/views"  ] && $MKDIR -p $SCRIPT_PATH/../storage/framework/views && touch $SCRIPT_PATH/../storage/framework/views/index.html
	[ ! -d "$SCRIPT_PATH/../storage/logs"  ] && $MKDIR -p $SCRIPT_PATH/../storage/logs && touch $SCRIPT_PATH/../storage/logs/index.html
	[ ! -d "$SCRIPT_PATH/../bootstrap/cache"  ] && $MKDIR -p $SCRIPT_PATH/../bootstrap/cache && touch $SCRIPT_PATH/../bootstrap/cache/index.html
	
	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineModule"  ] && $MKDIR -p $SCRIPT_PATH/../storage/DoctrineModule && touch $SCRIPT_PATH/../storage/DoctrineModule/index.html
	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineORMModule"  ] && $MKDIR  -p $SCRIPT_PATH/../storage/DoctrineORMModule && touch $SCRIPT_PATH/../storage/DoctrineORMModule/index.html
	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineORMModule/Hydrator"  ] && $MKDIR  -p $SCRIPT_PATH/../storage/DoctrineORMModule/Hydrator && touch $SCRIPT_PATH/../storage/DoctrineORMModule/Hydrator/index.html
	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineORMModule/Proxy"  ] && $MKDIR  -p $SCRIPT_PATH/../storage/DoctrineORMModule/Proxy && touch $SCRIPT_PATH/../storage/DoctrineORMModule/Proxy/index.html
	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineMongoODMModule"  ] && $MKDIR  -p $SCRIPT_PATH/../storage/DoctrineMongoODMModule && touch $SCRIPT_PATH/../storage/DoctrineMongoODMModule/index.html
	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineMongoODMModule/Hydrator"  ] && $MKDIR  -p $SCRIPT_PATH/../storage/DoctrineMongoODMModule/Hydrator && touch $SCRIPT_PATH/../storage/DoctrineMongoODMModule/Hydrator/index.html
	# [ ! -d "$SCRIPT_PATH/../storage/DoctrineMongoODMModule/Proxy"  ] && $MKDIR  -p $SCRIPT_PATH/../storage/DoctrineMongoODMModule/Proxy && touch $SCRIPT_PATH/../storage/DoctrineMongoODMModule/Proxy/index.html
fi


# for laravel
if [ -f artisan ]
	then
		($CD $SCRIPT_PATH/../ && $PHP artisan vendor:publish --tag=public --force)
		($CD $SCRIPT_PATH/../ && $PHP artisan config:clear && $PHP artisan cache:clear && composer dumpautoload)
fi

## SWAGGER NGINX ONLY
$RM -Rf $SCRIPT_PATH/../public/docs
$RM -Rf $SCRIPT_PATH/../public/swagger-ui

ln -s $SCRIPT_PATH/../storage/api-docs  $SCRIPT_PATH/../public/docs
ln -s $SCRIPT_PATH/../vendor/swagger-api/swagger-ui/dist  $SCRIPT_PATH/../public/swagger-ui

# Ignore Symbolic links
($CD $SCRIPT_PATH && $FIND $SCRIPT_PATH/../ -type l | sed -e s'/^\.\///g' >> $SCRIPT_PATH/../.gitignore)

($CD $SCRIPT_PATH && $CHMOD -R 0777 $SCRIPT_PATH/../storage/)
echo -e "$BLUE all paths created $NORMAL"
