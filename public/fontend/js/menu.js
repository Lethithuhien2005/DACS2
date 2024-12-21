
function showMenu(menu) {
    // Ẩn tất cả các phần menu trước
    var sections = document.querySelectorAll('.menu-section');
    sections.forEach(function(section) {
      section.style.display = 'none';
    });
  
    // Hiển thị phần menu tương ứng với giá trị menu
    var selectedMenu = document.querySelector('.' + menu);
    selectedMenu.style.display = 'block';
    //Using AOS to display animation
    AOS.refresh();
  }
  