// Function to handle input and textarea events
function handleInputEvents(event) {
    var input = event.target;
    var label = input.previousElementSibling;
  
    if (event.type === 'keyup') {
      if (input.value === '') {
        label.classList.remove('active', 'highlight');
      } else {
        label.classList.add('active', 'highlight');
      }
    } else if (event.type === 'blur') {
      if (input.value === '') {
        label.classList.remove('active', 'highlight');
      } else {
        label.classList.remove('highlight');
      }
    } else if (event.type === 'focus') {
      if (input.value === '') {
        label.classList.remove('highlight');
      } else if (input.value !== '') {
        label.classList.add('highlight');
      }
    }
  }
  
  // Add event listeners to input and textarea elements with the class 'form'
  var formElements = document.querySelectorAll('.form input, .form textarea');
  formElements.forEach(function (element) {
    element.addEventListener('keyup', handleInputEvents);
    element.addEventListener('blur', handleInputEvents);
    element.addEventListener('focus', handleInputEvents);
  });
  
  // Add click event listener to '.tab a' elements
  var tabLinks = document.querySelectorAll('.tab a');
  tabLinks.forEach(function (link) {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      var tabItem = link.parentElement;
      tabItem.classList.add('active');
      var siblings = Array.from(tabItem.parentElement.children).filter(function (item) {
        return item !== tabItem;
      });
      siblings.forEach(function (sibling) {
        sibling.classList.remove('active');
      });
      var target = link.getAttribute('href');
      var tabContents = document.querySelectorAll('.tab-content > div');
      tabContents.forEach(function (content) {
        if (content !== document.querySelector(target)) {
          content.style.display = 'none';
        }
      });
      document.querySelector(target).style.display = 'block';
    });
  });
