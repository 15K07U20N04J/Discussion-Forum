<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Signup for an iDiscuss Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forum/partials/_handleSignup.php" method="post">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="signupemail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="signupemail" name="signupemail"
                            aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="signuppass" class="form-label">Password</label>
                        <input type="password" class="form-control" name="signuppass" id="signuppass">
                    </div>
                    <div class="mb-3">
                        <label for="conPass" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="conPass" id="conPass">
                        <div id="emailHelp" class="form-text">Make sure to type the same password.</div>

                    </div>
                    <button type="submit" class="btn btn-primary">Signup</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>