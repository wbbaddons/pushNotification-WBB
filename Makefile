FILES = $(shell find files -type f)
WCF_FILES = $(shell find files_wcf -type f)

all: be.bastelstu.wbb.pushNotification.tar

be.bastelstu.wbb.pushNotification.tar: files.tar files_wcf.tar *.xml language/*.xml LICENSE
	tar cvf be.bastelstu.wbb.pushNotification.tar --numeric-owner --exclude-vcs -- files.tar files_wcf.tar *.xml language/*.xml LICENSE

files.tar: $(FILES)
	tar cvf files.tar --numeric-owner --exclude-vcs --transform='s,files/,,' -- $(FILES)

files_wcf.tar: $(WCF_FILES)
	tar cvf files_wcf.tar --numeric-owner --exclude-vcs --transform='s,files_wcf/,,' -- $(WCF_FILES)

clean:
	-rm -f files.tar
	-rm -f files_wcf.tar

distclean: clean
	-rm -f be.bastelstu.wbb.pushNotification.tar

.PHONY: distclean clean
