#check the markdown
#you'll probably want to customise this file if you want to use it

for i in README INSTALL; 
	do markdown $i > ~/public_html/mus/$i.html; 
done

