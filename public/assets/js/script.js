$(() => {
  function formatBlogDate(dateString) {
		const date = new Date(dateString);

		const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
		const months = [
			"January","February","March","April","May","June",
			"July","August","September","October","November","December"
		];

		let hours = date.getHours();
		const minutes = String(date.getMinutes()).padStart(2, '0');
		const ampm = hours >= 12 ? "pm" : "am";

		hours = hours % 12;
		hours = hours ? hours : 12; // convert "0" to "12"

		return `${days[date.getDay()]} ${date.getDate()} ${months[date.getMonth()]}, ${date.getFullYear()}. ${hours}:${minutes} ${ampm}`;
	}



	if(window.location.pathname === '/') {
		fetchLatestNews();

		function fetchLatestNews() {
			$.ajax({
				url: "/blog/latestNews",
				type: "GET",
				success: function (response) {
					let blogs = response.data;

					$("#blogContainer").html(""); // clear previous

					if (!blogs || blogs.length === 0) {
						$("#blogContainer").html(`
							<p class="text-center text-muted">No news available at the moment.</p>
						`);
						return;
					}

					blogs.forEach(blog => {
						$("#blogContainer").append(`
							<div class="col-md-6 col-sm-12" style="max-height: 250px">
								<div class="blog-singe no-margin row">

									<div class="col-sm-5 blog-img-tab">
										<img src="/${blog.image}" alt="${blog.title}">
									</div>

									<div class="col-sm-7 blog-content-tab">
										<h2>${blog.title}</h2>

										<p>
											<i class="fas fa-user"><small>Admin</small></i>
											<i class="fas fa-calendar"><small>(${formatBlogDate(blog.created_at) ?? 0})</small></i>
										</p>

										<p class="blog-desic">
											${blog.message.substring(0, 20)}...
										</p>

                    <div class="read-more"> 
                      <a href="/blog-detail/${blog.id}">
                        Read More <i class="fas fa-arrow-right"></i>
                      </a>
                    </div>

								</div>
							</div>
						`);
					});
				},

				error: function (xhr) {
					console.error(xhr);
					$("#blogContainer").html(`
						<p class="text-danger text-center">Failed to load news.</p>
					`);
				}
			});
		}
	}









  // Fetch and view all blogs with pagination
  if (window.location.pathname === '/blog') {

    function renderPagination(current, total, callback) {
      const container = $('#paginationControls');
      container.empty();

      if (total <= 1) return;

      const createButton = (pageNum, isActive = false) => {
        const btn = $(`<button class="btn btn-sm ${isActive ? 'btn-primary' : 'btn-outline-primary'} mx-1">${pageNum}</button>`);
        btn.on('click', () => callback(pageNum)); 
        return btn;
      };

      const addEllipsis = () => {
        container.append('<span class="mx-2">...</span>');
      };

      if (current > 1) container.append(createButton(current - 1).text('« Prev'));
      container.append(createButton(1, current === 1));

      if (current > 3) addEllipsis();

      for (let i = current - 1; i <= current + 1; i++) {
        if (i > 1 && i < total) {
          container.append(createButton(i, i === current));
        }
      }

      if (current < total - 2) addEllipsis();

      container.append(createButton(total, current === total));
      if (current < total) container.append(createButton(current + 1).text('Next »'));
    }

    let currentPage = 1;
    const limit = 10; // you can change

    loadBlogs(currentPage);

    function loadBlogs(page) {
        $.ajax({
            url: `/blog/getAllBlogs?page=${page}&limit=${limit}`,
            type: "GET",
            success: function (response) {
                let blogs = response.data;
                currentPage = response.currentPage;

                $("#blogContainer").html("");

                if (!blogs || blogs.length === 0) {
                    $("#blogContainer").html(`
                        <p class="text-center text-muted">No news available.</p>
                    `);
                    return;
                }

                blogs.forEach(blog => {
                    $("#blogContainer").append(`
                        <div class="col-md-6 col-sm-12" style="max-height: auto;">
                            <div class="blog-singe no-margin row">

                                <div class="col-sm-5 blog-img-tab">
                                    <img src="/${blog.image}" alt="${blog.title}">
                                </div>

                                <div class="col-sm-7 blog-content-tab">
                                    <h2>${blog.title}</h2>

                                    <p>
                                        <i class="fas fa-user"><small>Admin</small></i>
                                        <i class="fas fa-calendar">
                                            <small>(${formatBlogDate(blog.created_at)})</small>
                                        </i>
                                    </p>

                                    <p class="blog-desic">
                                        ${blog.message.substring(0, 20)}...
                                    </p>

                                    <div class="read-more">
                                        <a href="/blog-detail/${blog.id}">
                                            Read More <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    `);
                });

                // 🔥 Render pagination
                renderPagination(
                    response.currentPage,
                    response.totalPages,
                    (newPage) => loadBlogs(newPage) // callback
                );
            },

            error: function (xhr) {
                console.error(xhr);
                $("#blogContainer").html(`
                    <p class="text-danger text-center">Failed to load news.</p>
                `);
            }
        });
    }
  }




















  

  // Fetch and view single blog's details
  if(window.location.pathname.startsWith('/blog-detail')) {
    const blogId = window.location.pathname.split('/').pop();

    if (!blogId) {
      Swal.fire({
        icon: 'error',
        title: 'Invalid Access',
        text: 'No blog ID provided.',
      });
      return;
    }

    // 🔁 Fetch and Render Blog
    function loadBlogDetails(blogId, page = 1) {
      $.ajax({
        url: `/blog/getSingleBlog/${blogId}?page=${page}`,
        method: 'GET',
        success: function (response) {

          const blog = response.blog;
          const comments = response.comments;
          const pagination = response.pagination;

          let commentsHtml = '';

          commentsHtml += `<h4 class="comments-count">${pagination.total} Comment${pagination.total > 1 ? 's' : ''}</h4>`;

          if (comments.length) {
            comments.forEach((c, i) => {
              commentsHtml += `
                <div class="comment mb-4 p-3 border rounded shadow-sm bg-white">
                  <div class="d-flex align-items-start gap-3">
                    <img src="/images/blog/user-1.jpg" class="rounded-circle" width="50" height="50">

                    <div class="flex-grow-1">
                      <h6 class="fw-semibold mb-1">${c.name}</h6>
                      <small class="text-muted">${formatBlogDate(c.created_at)}</small>
                      <p class="mt-2">${c.comment}</p>
                    </div>
                  </div>
                </div>
              `;
            });

            // PAGINATION BUTTONS
            commentsHtml += `<div class="d-flex justify-content-between mt-3">`;

            if (pagination.current_page > 1) {
              commentsHtml += `
                <button class="btn btn-outline-secondary" onclick="loadBlogDetails(${blogId}, ${pagination.current_page - 1})">Previous</button>
              `;
            } else {
              commentsHtml += `<div></div>`;
            }

            if (pagination.current_page < pagination.last_page) {
              commentsHtml += `
                <button class="btn btn-outline-primary" onclick="loadBlogDetails(${blogId}, ${pagination.current_page + 1})">Next</button>
              `;
            }

            commentsHtml += `</div>`;
          } else {
            commentsHtml = `<p class="text-muted">No comments yet.</p>`;
          }

          const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const html = `
              <div class="col-12 mx-auto mb-5">
                <article style="box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);" class="entry entry-single border rounded shadow-lg bg-white p-4">
                  
                  <!-- Blog Image -->
                  <div class="entry-img mb-4 text-center">
                    <img src="/${blog.image}" alt="Blog Image" class="img-fluid rounded w-100" style="max-height: 400px; object-fit: cover;">
                  </div>

                  <!-- Title -->
                  <h2 class="entry-title mb-3 fw-bold text-dark">${blog.title}</h2>

                  <!-- Meta -->
                  <div class="entry-meta mb-3 text-muted small">
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item me-3"><i class="bi bi-person me-1"></i> Admin</li>
                      <li class="list-inline-item me-3"><i class="bi bi-clock me-1"></i><time datetime="${blog.created_at}">${formatBlogDate(blog.created_at)}</time></li>
                      <li class="list-inline-item"><i class="bi bi-chat-dots me-1"></i> ${blog.comments?.length || 0} Comments</li>
                    </ul>
                  </div>

                  <!-- Blog Message -->
                  <div class="entry-content text-dark mb-4 p-3 rounded shadow" style="background-color: #f8f9fa; line-height: 1.7; font-size: 15px;">
                    <p>${blog.message}</p>
                  </div>

                  <!-- Blog Comments -->
                  <div class="blog-comments mt-4 p-3 rounded shadow-sm" style="background-color: #ffffff; border: 1px solid #dee2e6;">
                    ${commentsHtml || '<p class="text-muted">No comments yet.</p>'}

                    <div class="reply-form mt-4">
                      <h4>Leave a Comment</h4>
                      <form id="commentForm">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <div class="row">
                          <div class="col-md-6 form-group">
                            <input name="name" type="text" class="form-control" placeholder="Your Name">
                          </div>
                          <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input name="email" type="email" class="form-control" placeholder="Your Email">
                          </div>
                        </div>
                        <div class="form-group mt-3">
                          <textarea name="comment" class="form-control" rows="5" placeholder="Comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-secondary mt-3">Post Comment</button>
                      </form>
                    </div>
                  </div>

                </article>
              </div>
            `;




          $('#blogContentWrapper').html(html);
          $('html, body').animate({ scrollTop: $('#blogContentWrapper').offset().top }, 300);
        },
        error: function () {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Unable to load blog details.',
          });
        }
      });
    }

    window.loadBlogDetails = loadBlogDetails;

    // Load blog when page loads
    loadBlogDetails(blogId, 1);




    // Handle comment submission
    $(document).on('submit', '#commentForm', function (e) {
      e.preventDefault();

      const name = $(this).find('input[name="name"]').val().trim();
      const email = $(this).find('input[name="email"]').val().trim();
      const comment = $(this).find('textarea[name="comment"]').val().trim();

      if (!name || !email || !comment) {
        Swal.fire({
          icon: 'warning',
          title: 'Incomplete Form',
          text: 'Please fill in all fields before submitting.',
        });
        return;
      }

      // Set CSRF token for all AJAX requests
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });


      // ✅ Show loading spinner before AJAX request
      Swal.fire({
        title: 'Adding Comment...',
        text: 'Please wait...',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading(); // shows spinner
        }
      });

      $.ajax({
        url: `/blog/${blogId}/addComment`,
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ name, email, comment }),
        success: function () {
          Swal.fire({
            icon: 'success',
            title: 'Comment Posted',
            text: 'Your comment has been successfully added.',
          }).then(() => {
            loadBlogDetails(blogId, 1); // 👈 Refresh content dynamically
          });
        },
        error: function (err) {
          console.error('Error posting comment:', err);
          Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: 'Unable to post comment. Please try again later.',
          });
        }
      });
    });

    // The sidebar for blog details page. It is supposed to be below but I am using it here to avoid duplication
    function renderLatestNews(blogs) {
      const container = $('.latest-news');
      container.empty();

      if (blogs.length === 0) {
        container.html('<div class="text-muted">No other blog posts available yet.</div>');
        return;
      }

      blogs.forEach((blog) => {
        const blogItem = `
          <div class="d-flex align-items-center mb-3 shadow" style="cursor: pointer;" onclick="window.location.href='/blog-detail/${blog.id}'">
            <img src="/${blog.image}" 
                alt="${blog.title}" 
                class="me-3 rounded" 
                width="60" 
                height="60" 
                style="object-fit: cover;"> &nbsp;&nbsp;
            <div>
              <h6 class="mb-1">
                <a href="/blog-detail/${blog.id}" 
                  class="text-decoration-none text-dark">
                  ${blog.title.length > 35 ? blog.title.substring(0, 35) + '...' : blog.title}
                </a>
              </h6>
            </div>
          </div>
        `;

        container.append(blogItem);
      });
    }

    // AJAX load blogs
    $.ajax({
      url: '/blog/latestNews',
      method: 'GET',
      success: function (response) {
        renderLatestNews(response.data);
      },
      error: function (err) {
        console.error('News fetch error:', err);
        $('#newsContainer').html('<div class="text-danger text-center">Error loading news.</div>');
      }
    });

  }

});










$( document ).ready(function() {
    var w = window.innerWidth;

    if(w > 767){
        $('#menu-jk').scrollToFixed();
    }else{
        $('#menu-jk').scrollToFixed();
    }



})


$( document ).ready(function() {

  $('.owl-carousel').owlCarousel({
      loop:true,
      margin:0,
      nav:true,
      autoplay: true,
      dots: true,
      autoplayTimeout: 5000,
      navText:['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
      responsive:{
          0:{
              items:1
          },
          600:{
              items:1
          },
          1000:{
              items:1
          }
      }
  });

 const galleryImages = document.querySelectorAll('.gallery img');
  const previewImage = document.getElementById('preview-image');
  const nextButton = document.getElementById('next-button');

  let currentImageIndex = 0; // Track current image index

  //Function to display preview image
  function displayPreview(image) {
    previewImage.src = image.dataset.preview; // Get preview image path from data-preview attribute
  }

  //Add click event listener to each gallery image
  galleryImages.forEach((image, index) => {
    image.addEventListener('click', () => {
      displayPreview(image);
      currentImageIndex = index; // Update current image index
    });
  });

  //Next button click event listener
  nextButton.addEventListener('click', () => {
  currentImageIndex++; // Increment current image index
    if (currentImageIndex >= galleryImages.length) {
      currentImageIndex = 0; // Reset index if it reaches the end
    }
    displayPreview(galleryImages[currentImageIndex]); // Display next image preview
    });

  //Display preview image on page load (optional)
    window.addEventListener('load', () => {
  displayPreview(galleryImages[currentImageIndex]);
  });

  });

    const imageHeight = galleryImages[0].offsetHeight; // Get height of the first image
    galleryImages.forEach(image => {
    image.style.height = `${imageHeight}px`;
      });


      const keyDivImages = document.querySelectorAll('.key-div img');

      function setEqualHeights() {
    const maxHeight = Math.max(...keyDivImages.map(img => img.offsetHeight));
    keyDivImages.forEach(img => img.style.height = `${maxHeight}px`);
  }

      window.addEventListener('load', setEqualHeights);

      $(document).ready(function() {
          $('[data-fancybox="gallery"]').fancybox({
            // Enable slideshow functionality (optional)
            slideShow: {
              autoStart: false, // Set to true for automatic slideshow
              speed: 300, // Animation speed in milliseconds
            },
        
            // Enable additional features
            arrows: true, // Display navigation arrows
            infobar: true, // Display information bar (counter and title)
            toolbar: true, // Display toolbar with zoom, full screen, etc. (requires `buttons` helper)
            buttons: [
              "zoom", // Enable zoom button
              "slideShow", // Enable slideshow toggle button (optional)
              "fullScreen", // Enable full screen button
              "download", // Enable download button (optional)
              "thumbs", // Enable thumbnail navigation (optional)
              "close" // Enable close button
            ],
        
            // Additional customization options (optional)
            transitionIn: 'fade', // Use Animate.css classes for animations (ensure Animate.css is included)
            transitionOut: 'fade',
          });
      
        
    const galleryImages = document.querySelectorAll('.frame img');

  function setEqualHeights() {
    const maxHeight = Math.max(...galleryImages.map(img => img.offsetHeight));
    galleryImages.forEach(img => img.style.height = `${maxHeight}px`);
  }

  window.addEventListener('load', setEqualHeights);



  // Countdown

  // Set the date we're counting down to
  const countDownDate = new Date("August 10, 2024 00:00:00").getTime();

  // Update the countdown every 1 second
  const countdownFunction = setInterval(function() {
    // Get the current date and time
    const now = new Date().getTime();
      
    // Calculate the remaining time
    const distance = countDownDate - now;
      
    // Calculate days, hours, minutes, and seconds
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
    // Display the countdown timer
    document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
    document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
    document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
    document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');
      
    // If the countdown is over, display a message
    if (distance < 0) {
      clearInterval(countdownFunction);
      document.getElementById("days").innerHTML = "00";
      document.getElementById("hours").innerHTML = "00";
      document.getElementById("minutes").innerHTML = "00";
      document.getElementById("seconds").innerHTML = "00";
    }
  }, 1000);

}); 





