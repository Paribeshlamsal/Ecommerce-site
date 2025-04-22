@if(Session::has('success'))
<div class="fixed top-8   right-5 mb-6 mr-6 flex items-center justify-center z-50" id="message">
    <p class="text-lg font-bold bg-red-600 text-white px-6 py-3 rounded-lg shadow-lg">
        {{ session('success') }}
    </p>
</div>
<script>
    setTimeout(() => {
        const messageElement = document.getElementById('message');
        messageElement.classList.add('opacity-0', 'transition', 'duration-500');
        setTimeout(() => {
            messageElement.style.display = 'none';
        }, 500); // match the duration of the transition
    }, 2000);
</script>
@endif
