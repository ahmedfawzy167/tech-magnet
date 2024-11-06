import './bootstrap';

function timeAgo(date) {
    const seconds = Math.floor((new Date() - new Date(date)) / 1000);
    let interval = Math.floor(seconds / 31536000);

    if (interval > 1) return interval + ' years ago';
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) return interval + ' months ago';
    interval = Math.floor(seconds / 86400);
    if (interval > 1) return interval + ' days ago';
    interval = Math.floor(seconds / 3600);
    if (interval > 1) return interval + ' hours ago';
    interval = Math.floor(seconds / 60);
    if (interval > 1) return interval + ' minutes ago';
    return seconds < 20 ? 'just now' : seconds + ' seconds ago';
}

window.Echo.channel('admin-notifications')
    .listen('StudentEnrollment', (event) => {
        let badge = document.querySelector('.badge-counter');
        badge.textContent = parseInt(badge.textContent) + 1;

        let notificationList = document.querySelector('.dropdown-list');
        notificationList.insertAdjacentHTML('afterbegin', `
            <a class="dropdown-item d-flex align-items-center" href="/notifications/${event.course.id}">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-user-plus text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">${event.created_at}</div>
                    <span class="font-weight-bold">${event.message}</span>
                </div>
            </a>
        `);
    });
