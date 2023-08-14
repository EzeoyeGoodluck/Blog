const navItems = document.querySelector('.nav__items')
const openNavbtn = document.querySelector('#open__nav-btn');
const closeNavBtn = document.querySelector('#close__nav-btn');


const openNav = () => {
    navItems.style.display = 'flex';
    openNavbtn.style.display = 'none';
    closeNavBtn.style.display = 'inline-block'; 
}


const closeNav = () => {
    navItems.style.display = 'none';
    openNavbtn.style.display = 'inline-block';
    closeNavBtn.style.display = 'none'; 
}


openNavbtn.addEventListener('click' , openNav);
closeNavBtn.addEventListener('click' , closeNav);




const sidebar = document.querySelector('aside');
const showSidebarBtn = document.querySelector('#show__side-bar-btn');
const hideSideBarBtn = document.querySelector('#hide__side-bar-btn');







const showSideBar = ()=>{
    sidebar.style.left = '0';
    showSidebarBtn.style.display = 'none';
    hideSideBarBtn.style.display = 'inline-block';
}

const hideSideBar = ()=>{
    sidebar.style.left = '-100%';
    showSidebarBtn.style.display = 'inline-block';
    hideSideBarBtn.style.display = 'none';

}

showSidebarBtn.addEventListener('click', showSideBar);
hideSideBarBtn.addEventListener('click', hideSideBar);


// Preventing animal disease
// Farmers are responsible for the health of their livestock. Sometimes, the government has to step in and help prevent or combat a disease. This is necessary if a disease is exceptionally infectious or dangerous. Livestock farmers must:
// •	ensure adequate hygiene at their place of business;
// •	be alert to symptoms of disease;
// •	comply with requirements when importing animals from countries outside the European Union (EU);
// •	vaccinate their animals if possible and necessary.
// •	take immediate action in the event of an outbreak of infectious animal disease;
// •	HomeSolutionTop Solutions to the Problems of Livestock Farming - New Discovering
