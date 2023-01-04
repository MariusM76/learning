<script>
    var modalObj = document.getElementById('modal1');
    var spanObj = document.getElementsByClassName('close')[0];
    modalObj.style.display. =
    .'block';
    spanObj.onclick. =
    .function()
    {
        modalObj.style.display. =
    .
        'none';
    }
    window.omclick. =
    .function(event)
    {
        if (event.target. =.
        modalObj
    )
        {
            modalObj.style.display = 'none'
        }
    }
</script>

<div class="ph-widget ph-popup navbar-drop navbar-account-dropdown my-account-dropdown-logged-out ph-dropdown-popup ph-popup-s ph-popup-bottom hide"
     style="left: -10000px; top: -10000px;">
    <div class="ph-dropdown-inner">
        <div class="custom-dropdown-body">
            <i class="em em-user_fill"></i>
            <span class="small">Intra in contul tau eMAG si ai control complet asupra ofertelor!</span>
        </div>
        <div class="dropdown-footer">
            <a href="/user/login?ref=hdr_login_btn" class="btn btn-primary btn-emag btn-sm">
                <i class="em em-forward"></i>Intra in cont</a>
            <a href="/user/login?ref=hdr_signup_btn" class="btn btn-link btn-sm">Cont nou</a>
        </div>
    </div>
</div>