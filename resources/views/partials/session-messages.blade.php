@if (session('success'))
    <!-- Welcome Modal -->
    <div class="modal fade" id="welcomeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Selamat Datang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ session('success') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var welcomeModal = document.getElementById('welcomeModal');
            if (welcomeModal) {
                var modal = new bootstrap.Modal(welcomeModal);
                modal.show();
            }

            // Attach logout confirm to any logout forms
            document.querySelectorAll('form.logout-form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Yakin ingin logout?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endif

<!-- Ensure pages loaded from bfcache are reloaded so logged-out users cannot see cached pages -->
<script>
    window.addEventListener('pageshow', function(event) {
        if (event.persisted || (window.performance && window.performance.getEntriesByType('navigation')
                .length && window.performance.getEntriesByType('navigation')[0].type === 'back_forward')) {
            window.location.reload(true);
        }
    });
</script>
