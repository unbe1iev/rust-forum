function getCookie(name) {
    if (document.cookie !== "") {
        const cookies = document.cookie.split(/; */);

        for (let i=0; i<cookies.length; i++) {
            const cookieName = cookies[i].split("=")[0];
            const cookieVal = cookies[i].split("=")[1];
            if (cookieName === decodeURIComponent(name)) {
                return decodeURIComponent(cookieVal);
            }
        }
    }
}

function getXMLHttpRequest(){
  try { return new XMLHttpRequest();} catch(err1) {
  try { return new ActiveXObject('Msxml2.XMLHTTP'); } catch(err2) {
    try { return new ActiveXObject('Microsoft.XMLHTTP');} catch(err3) {
    return false; }
  }
  }
}

var r= getXMLHttpRequest();

function processResponse(){
  var responseText = r.responseText.split("~");
  document.getElementById("toolpanel").innerHTML = responseText[0];
  document.getElementById("searchbar").innerHTML = responseText[1];
  document.getElementById("navigatebar").innerHTML = responseText[2];
  document.getElementById("articlerightpanel").innerHTML = responseText[3];
}

function searchcontent(permissionToSearch){
  var searchword = document.getElementById("searchfield").value;

  r.open("POST", "search.php");
  r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  r.onreadystatechange = processResponse;
  r.send("searchword=" + searchword + "&permissionToSearch=" + permissionToSearch);
}

function deleteArticleScript(id){
  r.open("GET", "deleteArticle.php?id=" + id);
  r.onreadystatechange = processResponse;
  r.send(null);
}

function editArticleForm(id, permission){
  r.open("POST", "editArticle.php");
  r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  r.onreadystatechange = processResponse;
  r.send("id=" + id + "&permission=" + permission);
}

function editArticleScript(id, permission){
  var category = document.getElementById("editArticleCategoryForm").value;
  var title = document.getElementById("editArticleTitleForm").value;
  var content = document.getElementById("editArticleContentForm").value;

  r.open("POST", "editArticle.php");
  r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  r.onreadystatechange = processResponse;
  r.send("id=" + id + "&permission=" + permission + "&title=" + title + "&category=" + category + "&content=" + content);
}

function previewArticle(id){
  r.open("GET", "previewArticle.php?id=" + id);
  r.onreadystatechange = processResponse;
  r.send(null);
}

function reload(category){
  if (getCookie('logged') == 1){
    r.open("POST", "profile.php");
    r.onreadystatechange = processResponse;
    r.send(null);
  } else{
    r.open("GET", "reloadPage.php?category=" + category);
    r.onreadystatechange = processResponse;
    r.send(null);
  }
}

function reloadOrdered(category, permission){
  r.open("POST", "reloadProfile.php");
  r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  r.onreadystatechange = processResponse;
  r.send("category=" + category + "&permission=" + permission);
}

function addArticleForm(permission){
  r.open("POST", "addArticle.php");
  r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  r.onreadystatechange = processResponse;
  r.send("permission=" + permission);
}

function addArticleScript(permission){
  var category = document.getElementById("addArticleCategoryForm").value;
  var title = document.getElementById("addArticleTitleForm").value;
  var content = document.getElementById("addArticleContentForm").value;

  r.open("POST", "addArticle.php");
  r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  r.onreadystatechange = processResponse;
  r.send("category=" + category + "&title=" + title + "&content=" + content + "&permission=" + permission);
}

function rootAddArticleScript(){
  var category = document.getElementById("addArticleCategoryForm").value;
  var title = document.getElementById("addArticleTitleForm").value;
  var content = document.getElementById("addArticleContentForm").value;

  r.open("POST", "rootAddArticle.php");
  r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  r.onreadystatechange = processResponse;
  r.send("category=" + category + "&title=" + title + "&content=" + content);
}

function register(){
      r.open("POST", "register.php");
      r.onreadystatechange = processResponse;
      r.send(null);
}

function registerScript(){
      var login = document.getElementById("login").value;
      var password1 = document.getElementById("password1").value;
      var password2 = document.getElementById("password2").value;

      r.open("POST", "register.php");
      r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      r.send("login=" + login + "&password1=" + password1 + "&password2=" + password2);
}

function signin(){
      r.open("POST", "signin.php");
      r.onreadystatechange = processResponse;
      r.send(null);
}

function signinScript(){
      var login = document.getElementById("login").value;
      var password1 = document.getElementById("password1").value;

      r.open("POST", "profile.php");
      r.onreadystatechange = processResponse;
      r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      r.send("login=" + login + "&password1=" + password1);
}

function backScript(){
    r.open("POST", "profile.php");
    r.onreadystatechange = processResponse;
    r.send(null);
}

function logOut(){
    r.open("POST", "logout.php");
    r.onreadystatechange = processResponse;
    r.send(null);
}
