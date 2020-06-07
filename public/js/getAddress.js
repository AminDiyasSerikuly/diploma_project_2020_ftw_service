class GetAddress {
    constructor(listener, toFind, anchorClass, once) {
        //toFind works only with classes(no Dots please)  anchorClass is an element we need to find to get an URL  once is required for only on match
        let count = true;
        const getURL = (el) => {

            for (let c = 0; c < el.children.length; c++) {
                if (count) {
                  let anchor = el.children[c];
                    if (anchor.tagName == 'A' || anchor.tagName == 'a' && anchor.classList[0] == anchorClass) {
                        
                        if (once != undefined) {
                            count = false;
                            c = el.children.length - 1;
                            window.location.href = anchor.getAttribute('href');       //redirect to found URL
                        }
                        if(count && once == undefined){
                          console.info(anchor.getAttribute('href'));                  //Может и пригодится)
                        }

                    } else {
                        if (once == undefined) {
                            getURL(el.children[c]);
                        } else if (count) {
                            getURL(el.children[c], once);
                        }

                    }
                } else {
                    c = el.children.length - 1;
                }
            }

        }

        const findDad = (el, missedParent) => {
            let elsDad = el.parentNode;
            if (elsDad.classList[0] != missedParent) { //look around for our element
                findDad(elsDad, missedParent);
            } else {
                getURL(elsDad); //if found call redirect
            }
        }

        this.listen = () => {
            document.querySelector(listener).addEventListener('click', function(e) {
                count = true;
                console.log(e);
                let offset;
                e.preventDefault();
                // if(e.toElement.offsetParent != undefined ) {
                //     offset = e.toElement.offsetParent;
                // }else{
                    offset = e.target.offsetParent;
                // }
                if (offset.classList[0] != toFind && e.target.classList[0] != toFind) {
                    findDad(offset, toFind);
                } else {
                    if (offset.classList[0] == toFind) {
                        getURL(offset);
                    } else if (e.target.classList[0]) {
                        getURL(e.target);
                    }
                }
            })
        }
    }
}

// Example of class use

// const url = new GetAddress('#load-data', 'card', 'card-title', 'stop');
// url.listen();