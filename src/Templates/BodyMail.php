<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Espaço Eudcar Mail</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<style>
    .img_sociais:hover {
        transform: scale(1.2);
    }
</style>

<body style="margin: 0; padding: 0;">
<table border="1" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td>
      <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
        <tr>
          <td align="center" bgcolor="#f9f9f9" style="padding: 30px 0 30px 0; border-radius: 8px">
            <img src="https://i.ibb.co/XzD5KXZ/logofim.png" alt="logofim" border="0" style="border-radius:  8px"/></td>
        </tr>
        <tr>
          <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
                  Email de recuperação de senha
                </td>
              </tr>
              <tr>
                <td style="padding: 20px 0 30px 0; margin: 0 1rem 0 1rem">
                  Caro usuário(a): <?= $user ?> foi solicitado através deste email a troca de sua antiga senha. Se você
                  solicitou a troca acesse o link abaixo e cadastre nova senha. O link abaixo tem tempo de validade de
                  24h para sua segurança utilize este link neste período, caso contrário refaça o processo de
                  recuperação de senha.
                  <p><a style="text-decoration: none; color: #333333"
                        href='http://localhost:3000/login/resetar/?hash=<?= $hash ?>'> Clique aqui </a>
                  </p>


                  A Espaço Educar jamais irá solicitar quaisquer informações sobre sua senha através de SMS, telefone ou
                  WhatsApp, se não foi solicitado nenhuma troca de senha desconsidere este email ou entre em contato
                  conosco espaco.educar.palmas@gmail.com.
                </td>
              </tr>
              <tr>
                <td>
                  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td width="260" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr>
                            <td>
                              <a href="http://localhost/api-ronycode/public/error"> <img
                                    src="https://i.ibb.co/5vKJ0x7/foguete.png" alt="foguete" border="0" width="100%"
                                    height="250" style="display: block;"></a>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding: 25px 0 0 0; line-height: 1.2">
                              Já garantiu a vaga de seu filho?
                              Matrículas abertas venha fazer parte do espaço que mais educa no Brasil.
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td style="font-size: 0; line-height: 0 ;" width="20">
                        &nbsp;
                      </td>
                      <td width="260" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr>
                            <td>
                              <a href="http://localhost/api-ronycode/public/error"><img
                                    src="https://i.ibb.co/Kq15wwC/banner-1.png" alt="banner-1" border="0" width="100%"
                                    height="250" style="display: block;"></a>
                            </td>
                          </tr>
                          <tr>
                            <td style="padding: 25px 0 0 0;">
                              Educar é mais que uma profissão é uma missão de vida, a Espaço Educar possui planos ideais
                              para você
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td bgcolor="#f1f1f1" style="padding: 30px 30px 30px 30px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td style="color: #333333; font-family: Arial, sans-serif; font-size: 14px;">
                  &reg; Espaço Educar, desenvolvido por RonyCode 2021<br/>
                  <a href="#" style="color: #ffffff;"><font color="#333333">
                      Remova sua inscrição</font></a> dessa e-mail marketing, instantaneamente
                </td>
                <td align="right">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>

                      <td>
                        <a href="https://www.facebook.com/suzukialves">
                          <img class="img_sociais" onmouseover="this.style.transform = 'scale(1.2)'"
                               onmouseout="this.style.transform = 'scale(1.0)'"
                               src="https://i.ibb.co/4PcT4tq/facebook-logo-icon-189224.png"
                               alt="facebook-logo-icon-189224" width="64" border="0">
                        </a>
                      </td>
                      <td>
                        <a href="https://www.instagram.com/prof.gi341/">
                          <img class="img_sociais" onmouseover="this.style.transform = 'scale(1.2)'"
                               onmouseout="this.style.transform = 'scale(1.0)'"
                               src="https://i.ibb.co/sRJDVdc/instagram-share-story-connection-communication-icon-189222.png"
                               alt="instagram-share-story-connection-communication-icon-189222" width="64" border="0">
                        </a>
                      </td>
                      <td>
                        <a href="http://api.whatsapp.com/send?phone=5563981270951">
                          <img class="img_sociais" onmouseover="this.style.transform = 'scale(1.2)'"
                               onmouseout="this.style.transform = 'scale(1.0)'"
                               src="https://i.ibb.co/SydC6gf/whatsapp-logo-icon-189219.png"
                               alt="whatsapp-logo-icon-189219" width="64" border="0">
                        </a>
                      </td>
                    </tr>
                  </table>
                </td>

              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>


</html>


<!--<style>-->
<!--    @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@900&display=swap');-->
<!---->
<!--</style>-->
<!---->
<!--<div style='-->
<!--max-width: 55%;-->
<!--max-height: 70vh;-->
<!--display: grid;-->
<!--grid-template-columns: 1fr 1fr;-->
<!--grid-template-rows: 8rem auto auto 5rem;-->
<!--margin: auto;-->
<!--'>-->
<!--  <div style='   grid-column: 1/3;-->
<!--        grid-row: 1/1;-->
<!--        background: #3f271a;'>-->
<!--    <nav style=' display: flex;-->
<!--        justify-content: space-between;-->
<!--        align-items: center;-->
<!--        margin: 1rem 2rem;'>-->
<!--      <img src='https://i.ibb.co/68nRmqb/logotipo-papagaiado.png' alt="logotipo" width="130" height="100">-->
<!--      <a style='  text-decoration: none;-->
<!--        font-size: 1.5rem;-->
<!--        color: #f1f1f1;-->
<!--        font-family: "Raleway Black", sans-serif;' href="">Contato</a>-->
<!--    </nav>-->
<!--  </div>-->
<!--  <div style='-->
<!--grid-column: 1/3;-->
<!--grid-row: 2/2;-->
<!--width: 100%;-->
<!--height: 60vh;'>-->
<!---->
<!--    <img style="position: absolute;-->
<!--z-index: -1;-->
<!--width: 54.5%;-->
<!--height: 60vh;-->
<!--margin: auto;-->
<!--" src="https://i.ibb.co/rdK5Gtf/02.jpg" alt="backgropund">-->
<!--    <h1>Email de troca de senha</h1>-->
<!--    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab ad autem delectus dolor dolorem dolores doloribus-->
<!--      ex id laborum, minima minus nesciunt quam quod sequi sit tempora tempore totam ut veritatis? Debitis illum nisi-->
<!--      porro quo repellendus! Ad atque dolore nemo velit vero vitae! Ad est exercitationem sequi vero.</p>-->
<!--  </div>-->
<!---->
<!--  <div style='  background: rgba(255,255,255,0.8);-->
<!--        grid-column: 1/1;-->
<!--        grid-row: 3/3;'>-->
<!--    <h1>coluna esquerda</h1>-->
<!--  </div>-->
<!---->
<!--  <div style=' background: rgba(255,255,255,0.8);-->
<!--        grid-column: 2/3;-->
<!--        grid-row: 3/3;'>-->
<!--    <h1>Descrição</h1>-->
<!--    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.-->
<!--      Culpa dolorum facilis itaque libero magni molestiae nemo nesciunt pariatur recusandae sequi!</p>-->
<!--  </div>-->
<!---->
<!--  <footer style='grid-column: 1/3;-->
<!--        grid-row: 4/4;-->
<!--        background: #e5f8d3;'>-->
<!--    <p>Ronycode &copy;2021 todos os direitos reservados.</p>-->
<!--  </footer>-->
<!---->
<!--</div>-->
<!---->
<!--"-->