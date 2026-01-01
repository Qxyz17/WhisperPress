/* WhisperPress Frontend - 静态版 */
function gen64id(){
  const arr = new Uint8Array(32);
  crypto.getRandomValues(arr);
  return Array.from(arr).map(b=>b.toString(16).padStart(2,'0')).join('');
}
const UID    = gen64id();                        // 64 位唯一 ID
const ROOM   = location.hash.slice(1) || UID.slice(-8); // 默认用后 8 字符当房间名

document.getElementById('room').textContent = ROOM;
const uidSpan = document.getElementById('uid');
uidSpan.textContent = UID;
uidSpan.onclick = ()=>{navigator.clipboard.writeText(UID);alert('已复制 64 位 ID\n粘贴到地址栏 # 后即可私聊');};

let key;
const enc = new TextEncoder(), dec = new TextDecoder();

async function deriveKey(pwd){
  const hash = await crypto.subtle.digest('SHA-256', enc.encode(pwd));
  return crypto.subtle.importKey('raw', hash, {name:'AES-GCM'}, false, ['encrypt','decrypt']);
}
function buf2hex(ab){return Array.from(new Uint8Array(ab)).map(b=>b.toString(16).padStart(2,'0')).join('')}
function hex2buf(hex){return new Uint8Array(hex.match(/.{1,2}/g).map(h=>parseInt(h,16)))}

async function encrypt(txt){
  const iv = crypto.getRandomValues(new Uint8Array(12));
  const ct = await crypto.subtle.encrypt({name:'AES-GCM', iv}, key, enc.encode(txt));
  return {iv:buf2hex(iv), ct:buf2hex(new Uint8Array(ct))};
}
async function decrypt({iv, ct}){
  const plain = await crypto.subtle.decrypt({name:'AES-GCM', iv:hex2buf(iv)}, key, hex2buf(ct));
  return dec.decode(plain);
}

function append(txt, sender='me'){ // sender: 'me' 或 'other'
  const div = document.createElement('div');
  div.className = 'msg' + (sender === 'me' ? ' me' : ' other');
  div.textContent = txt;
  screen.appendChild(div);
  screen.scrollTop = 1e9;
}

async function send(){
  const txt = inp.value.trim();
  if(!txt)return;
  const pkg = await encrypt(txt);

  // 保存消息到 localStorage，包含发送者信息
  let messages = JSON.parse(localStorage.getItem(ROOM)) || [];
  messages.push({pkg, sender: 'me'}); // sender: 'me' 表示自己发送
  localStorage.setItem(ROOM, JSON.stringify(messages));

  append(txt, 'me');
  inp.value='';
}

// 读取存储的消息并解密显示
async function loadMessages(){
  let messages = JSON.parse(localStorage.getItem(ROOM)) || [];
  for (const {pkg, sender} of messages) {
    append(await decrypt(pkg), sender);
  }
}

inp.onkeyup = e => { if (e.key === 'Enter') send(); };

deriveKey(ROOM).then(k => {
  key = k;
  loadMessages();
});
