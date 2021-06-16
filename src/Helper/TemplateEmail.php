<?php

namespace Api\Helper;

trait TemplateEmail
{
    public function bodyEmail(string $hash): string
    {
        return "
   <style>
    @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@900&display=swap');

</style>

<div style='
max-width: 55%;
max-height: 70vh;
display: grid;
grid-template-columns: 1fr 1fr;
grid-template-rows: 8rem auto auto 5rem;
margin: auto;
'>
  <img style='position: fixed;
z-index: -1;
width: 54.5%;
height: 100vh;
' src='https://i.ibb.co/rdK5Gtf/02.jpg' alt='backgropund' >

  <div style='   grid-column: 1/3;
        grid-row: 1/1;
        background: #3f271a;'>
    <nav style=' display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1rem 2rem;'>
      <img src='https://i.ibb.co/68nRmqb/logotipo-papagaiado.png' alt='logotipo' width='130' height='100'>
      <a style='  text-decoration: none;
        font-size: 1.5rem;
        color: #f1f1f1;
        font-family: 'Raleway Black', sans-serif;' href=''>Contato</a>
    </nav>
  </div>

  <div style='   grid-column: 1/3;
        grid-row: 2/2;
width: 100%;
height: 60vh;'>
    <h1>Email de troca de senha</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab ad autem delectus dolor dolorem dolores doloribus
      ex id laborum, minima minus nesciunt quam quod sequi sit tempora tempore totam ut veritatis? Debitis illum nisi
      porro quo repellendus! Ad atque dolore nemo velit vero vitae! Ad est exercitationem sequi vero.</p>
  </div>

  <div style='  background: rgba(255,255,255,0.8);
        grid-column: 1/1;
        grid-row: 3/3;'>
    <h1>coluna esquerda</h1>
  </div>

  <div style=' background: rgba(255,255,255,0.8);
        grid-column: 2/3;
        grid-row: 3/3;'>
    <h1>Descrição</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    Culpa dolorum facilis itaque libero magni molestiae nemo nesciunt pariatur recusandae sequi!</p>
  </div>

  <footer style='grid-column: 1/3;
        grid-row: 4/4;
        background: #e5f8d3;'>
    <p>Ronycode &copy;2021 todos os direitos reservados.</p>
  </footer>

</div>
        ";
    }
}
