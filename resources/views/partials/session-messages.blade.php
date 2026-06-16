<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('form.logout-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                if (!confirm('Yakin ingin logout?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>

<!-- Ensure pages loaded from bfcache are reloaded so logged-out users cannot see cached pages -->
<script>
    window.addEventListener('pageshow', function(event) {
        if (event.persisted || (window.performance && window.performance.getEntriesByType('navigation')
                .length && window.performance.getEntriesByType('navigation')[0].type === 'back_forward')) {
            window.location.reload(true);
        }
    });
</script>
