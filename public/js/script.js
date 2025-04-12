// Script para página de login/cadastro
document.addEventListener("DOMContentLoaded", function () {
  // Formulário de login
  const loginForm = document.getElementById("login-form");
  if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
      event.preventDefault();

      const email = document.getElementById("login-email").value;
      const password = document.getElementById("login-password").value;

      if (!email || !password) {
        alert("Por favor, preencha todos os campos.");
        return;
      }
a
      fetch("http://localhost:8000/api/login", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify({
          email: email,
          password: password,
        }),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Falha na autenticação");
          }
          return response.json();
        })
        .then((data) => {
          // Salvar token no localStorage
          localStorage.setItem("auth_token", data.token);
          localStorage.setItem("user_id", data.user.id);
          localStorage.setItem("user_name", data.user.name);

          // Redirecionar para a página de publicações
          window.location.href = "publicacoes.html";
        })
        .catch((error) => {
          console.error("Erro:", error);
          alert("Erro ao fazer login. Verifique suas credenciais.");
        });
    });
  }

// Formulário de cadastro
const registerForm = document.getElementById("register-form");
if (registerForm) {
  registerForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const name = document.getElementById("register-name").value;
    const email = document.getElementById("register-email").value;
    const password = document.getElementById("register-password").value;
    const confirmPassword = document.getElementById(
      "register-confirm-password"
    ).value;

    if (!name || !email || !password || !confirmPassword) {
      alert("Por favor, preencha todos os campos.");
      return;
    }

    if (password !== confirmPassword) {
      alert("As senhas não coincidem.");
      return;
    }

    fetch("http://localhost:8000/api/register", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify({
        name: name,
        email: email,
        password: password,
        password_confirmation: confirmPassword,
      }),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Falha no cadastro");
        }
        return response.json();
      })
      .then((data) => {
        // Mostrar mensagem de sucesso
        const successMessage = registerForm.querySelector(".w-form-done");
        if (successMessage) {
          successMessage.style.display = "block";
          successMessage.innerHTML = 
            '<div>Cadastro realizado com sucesso!<br>Por favor, faça login para acessar o Twitter Clone.</div>';
          
          // Esconder mensagem de erro se estiver visível
          const errorMessage = registerForm.querySelector(".w-form-fail");
          if (errorMessage) {
            errorMessage.style.display = "none";
          }
        }

        // Limpar o formulário
        registerForm.reset();

        // Rolagem para o topo para garantir que a mensagem seja visível
        window.scrollTo(0, 0);
      })
      .catch((error) => {
        console.error("Erro:", error);
        
        // Mostrar mensagem de erro
        const errorMessage = registerForm.querySelector(".w-form-fail");
        if (errorMessage) {
          errorMessage.style.display = "block";
          errorMessage.innerHTML = 
            '<div>Erro ao fazer cadastro. Verifique os dados informados.</div>';
          
          // Esconder mensagem de sucesso se estiver visível
          const successMessage = registerForm.querySelector(".w-form-done");
          if (successMessage) {
            successMessage.style.display = "none";
          }
        }
      });
  });
}

  // Verificar se o usuário já está logado
  // Esta verificação só será feita na página de login, não em publicacoes.html
  const token = localStorage.getItem("auth_token");
  const currentPage = window.location.pathname;

  if (token && currentPage.includes("index.html")) {
    // Se já estiver logado e estiver na página index, redirecionar para publicações
    window.location.href = "publicacoes.html";
  }
});

