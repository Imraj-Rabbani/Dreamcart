console.log('hello')


const selectDropdownTitle = document.getElementById('dropdownMenuButton')

if(selectDropdownTitle){
    selectDropdownTitle.addEventListener('click',function(){
        const selectDropdownMenu = document.getElementById('dropdown-menu')

        selectDropdownMenu.classList.toggle('dropdown-menu');
    })
}


