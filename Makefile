md:
	sh mdtest.s
push:
	chmod a+x www
	chmod a+r -R www
	rsync -Pre ssh www/ tims@leetmotif.net:/home/www/4gh.es/ --exclude=.svn --exclude=config.php --exclude=*.swp --exclude=*~
