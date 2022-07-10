<?php require_once( '../couch/cms.php' ); ?>
    <cms:template title='Users / Account Settings' hidden='1' />

    <!-- this is secured page. login first to access it -->
    <cms:if k_logged_out >
        <cms:redirect "<cms:login_link />" />
    </cms:if>
    
    <cms:capture into='my_content' >
        <!-- are there any success messages to show from previous save? -->
        <cms:set success_msg="<cms:get_flash 'success_msg' />" />
        <cms:if success_msg >
            <div class="alert-area">
                <div class="alert alert-success">
                    Profile updated.
                </div>
            </div>
        </cms:if>
    
        <!-- this ia regular databound-form -->
        <cms:form 
            masterpage=k_user_template 
            mode='edit'
            page_id=k_user_id
            enctype="multipart/form-data"
            method='post'
            anchor='0'
            class="offset-by-six sign-in"
            >
            
            <cms:if k_success >
            
                <cms:db_persist_form 
                    extended_user_password = frm_password
                    extended_user_password_repeat = frm_password_repeat
                />

                <cms:if k_success >
                    <cms:set_flash name='success_msg' value='1' />
                    <cms:redirect k_page_link /> 
                </cms:if>
            </cms:if>  
        
            <cms:if k_error >
                <div class="alert-area">
                    <div class="alert alert-error">
                        <cms:each k_error >
                            <cms:show item /><br>
                        </cms:each>
                    </div>
                </div>
            </cms:if>
            
            <label for="new-password">New password</label>
            <cms:input name='password' type="password" required='1' validator='min_len=5' id="new-password" />
            
            <label for="confirm-new-password">Confirm new password</label>
            <cms:input name='password_repeat' type="password" required='1' validator='matches_field=password' id="confirm-new-password" />
            
            <input type="submit" value="Save">
        </cms:form>
    </cms:capture>

    <cms:set my_title="Account Settings" />

    <cms:embed 'views/layout_main.html' />
    
<?php COUCH::invoke(); ?> 