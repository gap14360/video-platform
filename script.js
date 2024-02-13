function uploadVideos() {
    // Get the file input element
    var input = document.getElementById('file-input');
    var files = input.files;

    if (files.length > 0) {
        // Create a FormData object
        var formData = new FormData();

        // Append each file to FormData
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            formData.append('videos[]', file);
        }

        // Send FormData to server using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'upload.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Videos uploaded successfully!');
            } else {
                alert('Error uploading videos. Please try again.');
            }
        };
        xhr.send(formData);
    } else {
        alert('Please select at least one video to upload.');
    }
}

// Prevent default behavior for drag-and-drop
window.addEventListener("dragover", function(e) {
    e.preventDefault();
}, false);
window.addEventListener("drop", function(e) {
    e.preventDefault();
}, false);

// Handle drop event
var dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    var files = e.dataTransfer.files;

    if (files.length > 0) {
        var input = document.getElementById('file-input');
        input.files = files;
        dropZone.innerHTML = '<p>' + files.length + ' videos selected</p>';
    }
});



const videoPlayer = document.getElementById('video-player');

function skipBackward() {
    videoPlayer.currentTime -= 10;
}

function skipForward() {
    videoPlayer.currentTime += 10;
}

function deleteVideo() {
    if (confirm("Are you sure you want to delete this video?")) {
        // Here you can implement AJAX to send a request to the server to delete the video
        alert("Video deleted successfully!");
        // Redirect to a different page or perform any other action after deletion
    }
}

