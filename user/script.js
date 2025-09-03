// Smooth scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({ behavior: 'smooth' });
    }
  });
});

// Header background effect on scroll
window.addEventListener('scroll', function() {
  const header = document.querySelector('header');
  if (window.scrollY > 100) {
    header.style.background = 'rgba(255, 255, 255, 0.95)';
    header.style.backdropFilter = 'blur(10px)';
  } else {
    header.style.background = 'white';
    header.style.backdropFilter = 'none';
  }
});

  //search bar
    function searchJobs() {
      let input = document.getElementById("searchInput").value.toLowerCase();
      let jobs = document.getElementsByClassName("job-card");

      for (let i = 0; i < jobs.length; i++) {
        let jobTitle = jobs[i].getElementsByTagName("h3")[0].innerText.toLowerCase();
        if (jobTitle.includes(input)) {
          jobs[i].style.display = "block";  // show
        } else {
          jobs[i].style.display = "none";   // hide
        }
      }
    }

