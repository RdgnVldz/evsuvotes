<style>
  /* Add CSS classes to control the layout */
.footer-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.left-content {
    order: 1; /* Set the order to 1 for left content */
}

.right-content {
    order: 2; /* Set the order to 2 for right content */
}

/* Media query for desktop view (adjust the breakpoint as needed) */
@media (min-width: 769px) {
    .footer-content {
        flex-direction: row;
        justify-content: space-between; /* Separate content in desktop view */
        text-align: left; /* Align text to the left in desktop view */
    }

    .left-content {
        order: 0; /* Reset the order for left content */
    }

    .right-content {
        order: 1; /* Reset the order for right content */
    }
}
</style>
<footer class="main-footer">
    <div class="container">
        <div class="footer-content">
            <div class="left-content">
                <strong>&copy; 2023 <a style="color: white;" href="https://www.evsu.edu.ph/">Eastern Visayas State University</a></strong>
            </div>
            <div class="right-content hidden-xs">
                <b>All Rights Reserved.</b>
            </div>
        </div>
    </div>
    <!-- /.container -->
</footer>

