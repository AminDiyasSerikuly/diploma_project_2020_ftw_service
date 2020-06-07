 window.onload=function(){
	const example = document.querySelector('#example-anchor-home');
	const searchField = document.querySelector('#h-form-input');
	const searchBtn = document.querySelector('#btn-search');
	const addText = (count,el)=>{
		searchField.value += el[count];
				if( count + 1 < el.length){
					setTimeout(	
						()=>{
							addText( count + 1 , el );			
						},100
					);
				}else{
					searchBtn.classList.add('pulse');
					setTimeout(
						()=>{
							searchBtn.classList.remove('pulse');
						},3000
					);
				}
	}
	example.addEventListener('click',(e)=>{
		e.preventDefault();
		searchField.value="";
			addText( 0 , example.innerText );
	})

	const showCategoriesBtn = document.querySelector('#show-more');
	const categoriesBlockHidden  = document.querySelector('.categories-block-hidden');

	showCategoriesBtn.addEventListener('click',function(e){
		$(this).hide('fast');
		// categoriesBlockHidden.show('slow');
		categoriesBlockHidden.style.display="block";
		setTimeout(()=>{
			categoriesBlockHidden.style.opacity="1";	
		},500);
		
	})
 }