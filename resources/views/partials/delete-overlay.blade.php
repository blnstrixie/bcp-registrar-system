<div id="deleteOverlay" class="overlay">
    <div class="overlay-content" id="deleteOverlay-content">
        <button class="close-btn" onclick="hideDeleteConfirmation()">&times;</button>
        <div class="confirmation-message">
            <p> 
                Are you sure you want to delete this? 
            </p>
        </div>

        <div class="confirmation-buttons">
            <button class="delete-btn" onclick="deleteUser()">
                Yes
            </button>

            <button class="cancel-delete-btn">
                No
            </button>
        </div>
    </div>
</div>
