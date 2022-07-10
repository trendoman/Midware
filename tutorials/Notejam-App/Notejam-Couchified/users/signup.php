<?php require_once( '../couch/cms.php' ); ?>
    <cms:template title='Users / Sign Up' hidden='1' />
    
    <cms:if k_logged_in >
        <!-- what is an already logged-in member doing on this page? Send back to homepage. -->
        <cms:redirect k_site_link />
    </cms:if>
    
    <cms:capture into='my_content' >
        <!-- are there any success messages to show from previous actions? -->
        <cms:set success_msg="<cms:get_flash 'success_msg' />" />
        <cms:if success_msg >
            <div class="notice">
                <cms:if success_msg='1' >
                    Your account has been created successfully and we have sent you an email.<br />
                    Please click the verification link within that mail to activate your account.
                <cms:else />
                    Activation was successful! You can now log in!<br />
                    <a href="<cms:login_link redirect=k_site_link />">Login</a>
                </cms:if>
            </div>
        <cms:else />
            <!-- now the real work -->
            <cms:set action="<cms:gpc 'act' method='get'/>" />
            
            <!-- is the visitor here by clicking the account-activation link we emailed? -->
            <cms:if action='activate' >
                <h1>Activate account</h1>
            
                <cms:process_activation />
                
                <cms:if k_success >
                     <cms:set_flash name='success_msg' value='2' />
                     <cms:redirect k_page_link />          
                <cms:else />
                    <cms:show k_error />
                </cms:if>
            
            <cms:else /><!-- show the registration form -->
                <cms:form 
                        masterpage=k_user_template 
                        mode='create'
                        enctype='multipart/form-data'
                        method='post'
                        anchor='0'
                        
                        class="offset-by-six sign-in"
                        >
                    
                        <cms:if k_success >        

                            <cms:check_spam email=frm_extended_user_email />            

                            <cms:db_persist_form 
                                _invalidate_cache='0'
                                k_page_name = "<cms:random_name />"
                                k_page_title = frm_email
                                extended_user_email = frm_email
                                extended_user_password = frm_password
                                extended_user_password_repeat = frm_password_repeat
                                k_publish_date = '0000-00-00 00:00:00'
                            />                    

                            <cms:if k_success >
                                <!-- send email -->                    
                                <cms:embed 'activation_email.html' />
                                
                                <cms:set_flash name='success_msg' value='1' />
                                <cms:redirect k_page_link />
                            </cms:if> 
                        </cms:if>
                        
                     <cms:if k_error>
                        <div class="alert-area">
                            <div class="alert alert-error">
                                <cms:each k_error >
                                    <cms:show item /><br>
                                </cms:each>
                            </div>
                        </div>
                    </cms:if>    
                    
                    <label for="email">Email</label>
                    <cms:input name='email' type='text' required='1' validator='email' id="email"  />
                    
                    <label for="password">Password</label>
                    <cms:input name='password' type='password' required='1' validator='min_len=5' id="password"  />
                    
                    <label for="confirm-password">Confirm password</label>
                    <cms:input name='password_repeat' type='password' required='1' validator='matches_field=password' id="confirm-password"  />
                    
                    <input type="submit" value="Sign Up"> or <a href='<cms:login_link redirect=k_site_link />'>Sign in</a>
                    
                </cms:form>
            </cms:if>
        </cms:if>        
    </cms:capture>

    <cms:set my_title="Sign Up" />

    <cms:embed 'views/layout_main.html' />
    
<?php COUCH::invoke(); ?> 
