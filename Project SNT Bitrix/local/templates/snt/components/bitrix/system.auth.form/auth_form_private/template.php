<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init();
?>
<? if (!$USER->IsAuthorized()) header("Location: /authorization/");?>        <!--Переводим неавторизованных пользователей -->
<div class="bx-system-auth-form">

    <? if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']): ?>
    <? endif ?>

    <? if ($arResult["FORM_TYPE"] == "login"): ?>
        <h3 class="title">Войти в систему</h3>
        <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top"
              action="<?= $arResult["AUTH_URL"] ?>" id="auth">
            <?
            if ($arResult["BACKURL"] <> ''): ?>
                <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
            <?endif ?>
            <?
            foreach ($arResult["POST"] as $key => $value): ?>
                <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
            <?endforeach ?>
            <input type="hidden" name="AUTH_FORM" value="Y"/>
            <input type="hidden" name="TYPE" value="AUTH"/>
            <table width="95%">
                <tr>
                    <td colspan="2">
                        <input type="text" placeholder="Логин" class="req2" name="USER_LOGIN" maxlength="50" value=""
                               size="17"/>
                        <script>
                            BX.ready(function () {
                                var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                                if (loginCookie) {
                                    var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                                    var loginInput = form.elements["USER_LOGIN"];
                                    loginInput.value = loginCookie;
                                }
                            });
                        </script>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="password" placeholder="Пароль" class="req2" name="USER_PASSWORD" maxlength="255"
                               size="17" autocomplete="off"/>
                        <?
                        if ($arResult["SECURE_AUTH"]): ?>
                            <span class="bx-auth-secure" id="bx_auth_secure<?= $arResult["RND"] ?>" title="<?
                            echo GetMessage("AUTH_SECURE_NOTE") ?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
                            <noscript>
				<span class="bx-auth-secure" title="<?
                echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
                            </noscript>
                            <script type="text/javascript">
                                document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
                            </script>
                        <?endif ?>
                    </td>
                </tr>
                <?
                if ($arResult["STORE_PASSWORD"] == "Y"): ?>
                    <tr>
                        <td><label for="USER_REMEMBER_frm" class="checkbox-other"
                                   title="<?= GetMessage("AUTH_REMEMBER_ME") ?>">
                                <input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y"/>
                                <span class="checkbox-other-text">Запомнить меня</span>
                            </label>
                        </td>
                    </tr>
                <?endif ?>
                <?
                if ($arResult["CAPTCHA_CODE"]): ?>
                    <tr>
                        <td colspan="2">
                            <?
                            echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:<br/>
                            <input type="hidden" name="captcha_sid" value="<?
                            echo $arResult["CAPTCHA_CODE"] ?>"/>
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?
                            echo $arResult["CAPTCHA_CODE"] ?>" width="180" height="40" alt="CAPTCHA"/><br/><br/>
                            <input type="text" name="captcha_word" maxlength="50" value=""/></td>
                    </tr>
                <?endif ?>
                <tr>
                    <td colspan="2"><input type="submit" name="Login" value="<?= GetMessage("AUTH_LOGIN_BUTTON") ?>"/>
                    </td>
                </tr>
                <?
                if ($arResult["NEW_USER_REGISTRATION"] == "Y"): ?>
                    <tr>
                        <td colspan="2" align="left">
                            <noindex><a class="cabinet_header cabinet-link" href="<?= $arResult["AUTH_REGISTER_URL"] ?>"
                                        rel="nofollow"><?= GetMessage("AUTH_REGISTER") ?></a></noindex>
                            <br/></td>
                    </tr>
                <?endif ?>

                <tr>
                    <td colspan="2" align="left">
                        <noindex><a class="cabinet_header cabinet-link" href="<?= $arResult["AUTH_FORGOT_PASSWORD_URL"] ?>"
                                    rel="nofollow"><?= GetMessage("AUTH_FORGOT_PASSWORD_2") ?></a></noindex>
                    </td>
                </tr>
                <?
                if ($arResult["AUTH_SERVICES"]): ?>
                    <tr>
                        <td colspan="2">
                            <div class="bx-auth-lbl"><?= GetMessage("socserv_as_user_form") ?></div>
                            <?
                            $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons",
                                array(
                                    "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                                    "SUFFIX" => "form",
                                ),
                                $component,
                                array("HIDE_ICONS" => "Y")
                            );
                            ?>
                        </td>
                    </tr>
                <?endif ?>
            </table>
        </form>

        <?
        if ($arResult["AUTH_SERVICES"]): ?>
            <?
            $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
                array(
                    "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                    "AUTH_URL" => $arResult["AUTH_URL"],
                    "POST" => $arResult["POST"],
                    "POPUP" => "Y",
                    "SUFFIX" => "form",
                ),
                $component,
                array("HIDE_ICONS" => "Y")
            );
            ?>
        <?endif ?>

    <?
    elseif ($arResult["FORM_TYPE"] == "otp"):
        ?>

        <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top"
              action="<?= $arResult["AUTH_URL"] ?>">
            <?
            if ($arResult["BACKURL"] <> ''):?>
                <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
            <?endif ?>
            <input type="hidden" name="AUTH_FORM" value="Y"/>
            <input type="hidden" name="TYPE" value="OTP"/>
            <table width="95%">
                <tr>
                    <td colspan="2">
                        <?
                        echo GetMessage("auth_form_comp_otp") ?><br/>
                        <input type="text" name="USER_OTP" maxlength="50" value="" size="17" autocomplete="off"/></td>
                </tr>
                <?
                if ($arResult["CAPTCHA_CODE"]):?>
                    <tr>
                        <td colspan="2">
                            <?
                            echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:<br/>
                            <input type="hidden" name="captcha_sid" value="<?
                            echo $arResult["CAPTCHA_CODE"] ?>"/>
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?
                            echo $arResult["CAPTCHA_CODE"] ?>" width="180" height="40" alt="CAPTCHA"/><br/><br/>
                            <input type="text" name="captcha_word" maxlength="50" value=""/></td>
                    </tr>
                <?endif ?>
                <?
                if ($arResult["REMEMBER_OTP"] == "Y"):?>
                    <tr>
                        <td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y"/>
                        </td>
                        <td width="100%"><label for="OTP_REMEMBER_frm" title="<?
                            echo GetMessage("auth_form_comp_otp_remember_title") ?>"><?
                                echo GetMessage("auth_form_comp_otp_remember") ?></label></td>
                    </tr>
                <?endif ?>
                <tr>
                    <td colspan="2"><input type="submit" name="Login" value="<?= GetMessage("AUTH_LOGIN_BUTTON") ?>"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <noindex><a href="<?= $arResult["AUTH_LOGIN_URL"] ?>" rel="nofollow"><?
                                echo GetMessage("auth_form_comp_auth") ?></a></noindex>
                        <br/></td>
                </tr>
            </table>
        </form>

    <?
    else:
        ?>
        <form action="<?= $arResult["AUTH_URL"] ?>" > <!--Убрали лишние ссылки оставили только 'выйти' -->
            <table width="290px">
                <tr>
                    <td align="center">
                        <? foreach ($arResult["GET"] as $key => $value):?>
                            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                        <? endforeach ?>
                        <?= bitrix_sessid_post() ?>
                        <input type="hidden" name="logout" value="yes"/>
                        <input type="submit" class="logout__button" name="logout_butt" value="<?= GetMessage("AUTH_LOGOUT_BUTTON") ?>"/>
                    </td>
                </tr>
            </table>
        </form>
    <? endif ?>
    <script>                  /*Окрашиваем незаполненные поля*/
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('auth');
            form.addEventListener('submit', function (e) {
                if (formValidate(form)) e.preventDefault();  /* Обрываем логику если есть путые поля*/

                function formValidate(form) {
                    let error = 0;
                    let formReq = document.querySelectorAll('.req2');

                    for (let i = 0; i < formReq.length; i++) {
                        const input = formReq[i];
                        formRemoveError(input);
                        if (input.value === '') {
                            formAddError(input);
                            error++;
                        }
                    }
                    return error;
                }

                function formAddError(input) {
                    input.classList.add('error');
                }

                function formRemoveError(input) {
                    input.classList.remove('error');
                }
            })

        })
    </script>
</div>