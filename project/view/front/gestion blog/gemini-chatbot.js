// Gemini Chatbot for Travel Blog
// Custom Gemini chatbot for blog.php with travel categories suggestions and matching design

const GEMINI_API_KEY = "AIzaSyAL6Ecgyh97yTWcIyeNTReXk7MeJTXHhgM";
const GEMINI_API_URL = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent?key=" + GEMINI_API_KEY;

function createChatbotBox() {
    // Create chat container
    const chatContainer = document.createElement('div');
    chatContainer.id = 'gemini-chatbot-container';
    chatContainer.style.position = 'fixed';
    chatContainer.style.bottom = '32px';
    chatContainer.style.right = '32px';
    chatContainer.style.width = '400px';
    chatContainer.style.maxHeight = '620px';
    chatContainer.style.background = '#fff';
    chatContainer.style.border = '1.5px solid #e0e6ed';
    chatContainer.style.borderRadius = '28px';
    chatContainer.style.boxShadow = '0 8px 40px rgba(43,144,217,0.13)';
    chatContainer.style.zIndex = '9999';
    chatContainer.style.display = 'flex';
    chatContainer.style.flexDirection = 'column';
    chatContainer.style.overflow = 'hidden';
    chatContainer.style.fontFamily = 'Poppins, Arial, sans-serif';
    chatContainer.style.transition = 'box-shadow 0.18s, background 0.18s';
    chatContainer.style.backdropFilter = 'blur(1.5px)';

    // Header
    const header = document.createElement('div');
    header.style.background = '#2b90d9';
    header.style.color = '#fff';
    header.style.padding = '18px 24px 18px 28px';
    header.style.fontWeight = 'bold';
    header.style.fontSize = '20px';
    header.style.textAlign = 'center';
    header.style.display = 'flex';
    header.style.alignItems = 'center';
    header.style.justifyContent = 'space-between';
    header.style.borderTopLeftRadius = '28px';
    header.style.borderTopRightRadius = '28px';
    header.style.cursor = 'move';
    header.style.userSelect = 'none';
    header.style.boxShadow = '0 2px 8px rgba(43,144,217,0.10)';

    // Title
    const title = document.createElement('span');
    title.innerText = 'Travel Blog Chatbot';
    header.appendChild(title);

    // Minimize button
    const minimizeBtn = document.createElement('button');
    minimizeBtn.innerHTML = '&#8211;';
    minimizeBtn.title = 'Minimize';
    minimizeBtn.style.background = '#ff6700';
    minimizeBtn.style.border = 'none';
    minimizeBtn.style.color = '#fff';
    minimizeBtn.style.fontSize = '22px';
    minimizeBtn.style.cursor = 'pointer';
    minimizeBtn.style.marginLeft = '8px';
    minimizeBtn.style.fontWeight = 'bold';
    minimizeBtn.style.borderRadius = '10px';
    minimizeBtn.style.padding = '2px 12px';
    minimizeBtn.style.transition = 'background 0.18s, box-shadow 0.18s';
    minimizeBtn.onmouseenter = () => {
        minimizeBtn.style.background = '#e65c00';
        minimizeBtn.style.boxShadow = '0 2px 8px rgba(255,103,0,0.12)';
    };
    minimizeBtn.onmouseleave = () => {
        minimizeBtn.style.background = '#ff6700';
        minimizeBtn.style.boxShadow = 'none';
    };
    header.appendChild(minimizeBtn);

    chatContainer.appendChild(header);

    // --- Drag logic ---
    let isDragging = false;
    let dragOffsetX = 0;
    let dragOffsetY = 0;
    header.addEventListener('mousedown', function(e) {
        if (e.target === minimizeBtn) return; // Don't drag if clicking minimize
        isDragging = true;
        dragOffsetX = e.clientX - chatContainer.getBoundingClientRect().left;
        dragOffsetY = e.clientY - chatContainer.getBoundingClientRect().top;
        document.body.style.userSelect = 'none';
    });
    document.addEventListener('mousemove', function(e) {
        if (!isDragging) return;
        chatContainer.style.transition = 'none';
        let newLeft = e.clientX - dragOffsetX;
        let newTop = e.clientY - dragOffsetY;
        // Boundaries (keep at least 40px visible on each side)
        const minLeft = 40;
        const minTop = 10;
        const maxLeft = window.innerWidth - chatContainer.offsetWidth - 40;
        const maxTop = window.innerHeight - chatContainer.offsetHeight - 10;
        newLeft = Math.max(minLeft, Math.min(newLeft, maxLeft));
        newTop = Math.max(minTop, Math.min(newTop, maxTop));
        chatContainer.style.left = newLeft + 'px';
        chatContainer.style.top = newTop + 'px';
        chatContainer.style.right = '';
        chatContainer.style.bottom = '';
        chatContainer.style.position = 'fixed';
    });
    document.addEventListener('mouseup', function() {
        if (isDragging) {
            isDragging = false;
            chatContainer.style.transition = '';
            document.body.style.userSelect = '';
        }
    });

    // Messages area
    const messages = document.createElement('div');
    messages.id = 'gemini-chatbot-messages';
    messages.style.flex = '1';
    messages.style.padding = '32px 32px 18px 32px';
    messages.style.overflowY = 'auto';
    messages.style.background = '#f7f9fb';
    messages.style.fontFamily = 'Poppins, Arial, sans-serif';
    chatContainer.appendChild(messages);

    // Input area
    const inputArea = document.createElement('div');
    inputArea.style.display = 'flex';
    inputArea.style.flexDirection = 'column';
    inputArea.style.alignItems = 'center';
    inputArea.style.borderTop = '1.5px solid #e0e6ed';
    inputArea.style.background = '#fff';
    inputArea.style.padding = '18px 0 0 0';

    // Row for input and mic
    const inputRow = document.createElement('div');
    inputRow.style.display = 'flex';
    inputRow.style.flexDirection = 'row';
    inputRow.style.justifyContent = 'center';
    inputRow.style.alignItems = 'center';
    inputRow.style.width = '100%';

    // Input
    const input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'Ask about travel, tips, or categories...';
    input.style.width = '76%';
    input.style.padding = '12px 18px';
    input.style.border = '1.5px solid #e0e6ed';
    input.style.borderRadius = '12px';
    input.style.marginBottom = '8px';
    input.style.fontSize = '16px';
    input.style.outline = 'none';
    input.style.background = '#f7f9fb';
    input.style.fontFamily = 'Poppins, Arial, sans-serif';
    inputRow.appendChild(input);
    // Mic Button
    const micBtn = document.createElement('button');
    micBtn.type = 'button';
    micBtn.id = 'geminiMicBtn';
    micBtn.title = 'Speak to add text';
    micBtn.style.background = '#fff';
    micBtn.style.border = '1.5px solid #e0e6ed';
    micBtn.style.borderRadius = '50%';
    micBtn.style.width = '44px';
    micBtn.style.height = '44px';
    micBtn.style.display = 'flex';
    micBtn.style.alignItems = 'center';
    micBtn.style.justifyContent = 'center';
    micBtn.style.marginLeft = '10px';
    micBtn.style.marginBottom = '8px';
    micBtn.style.transition = 'background 0.2s, border 0.2s';
    micBtn.innerHTML = '<span id="geminiMicIcon" style="font-size:20px;color:#333;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8 12a3 3 0 0 0 3-3V5a3 3 0 0 0-6 0v4a3 3 0 0 0 3 3z"/><path d="M5 10.5a.5.5 0 0 1 .5.5v.5a2.5 2.5 0 0 0 5 0v-.5a.5.5 0 0 1 1 0v.5a3.5 3.5 0 0 1-7 0v-.5a.5.5 0 0 1 .5-.5z"/><path d="M8 15a.5.5 0 0 1-.5-.5V14h1v.5a.5.5 0 0 1-.5.5z"/></svg></span>';
    inputRow.appendChild(micBtn);
    inputArea.appendChild(inputRow);
    // Send Button
    const sendBtn = document.createElement('button');
    sendBtn.innerText = 'Send';
    sendBtn.style.background = '#2b90d9';
    sendBtn.style.color = '#fff';
    sendBtn.style.border = 'none';
    sendBtn.style.padding = '10px 0';
    sendBtn.style.cursor = 'pointer';
    sendBtn.style.fontWeight = 'bold';
    sendBtn.style.borderRadius = '10px';
    sendBtn.style.fontSize = '1.06rem';
    sendBtn.style.margin = '0 0 8px 0';
    sendBtn.style.display = 'block';
    sendBtn.style.width = '84%';
    sendBtn.style.boxShadow = '0 2px 8px rgba(43,144,217,0.08)';
    sendBtn.style.transition = 'background 0.18s, box-shadow 0.18s';
    sendBtn.onmouseenter = () => {
        sendBtn.style.background = '#ff6700';
        sendBtn.style.boxShadow = '0 4px 14px rgba(255,103,0,0.12)';
    };
    sendBtn.onmouseleave = () => {
        sendBtn.style.background = '#2b90d9';
        sendBtn.style.boxShadow = '0 2px 8px rgba(43,144,217,0.08)';
    };
    inputArea.appendChild(sendBtn);
    chatContainer.appendChild(inputArea);
    // --- Voice to text logic ---
    (function(){
      var micIcon = micBtn.querySelector('#geminiMicIcon');
      var recognizing = false;
      var recognition;
      if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SpeechRecognition();
        recognition.lang = 'en-US';
        recognition.continuous = true;
        recognition.interimResults = true;
        recognition.onresult = function(event) {
          var transcript = event.results[0][0].transcript;
          input.value += (input.value ? ' ' : '') + transcript;
        };
        recognition.onend = function() {
          recognizing = false;
          micBtn.style.background = '#eee';
        };
        micBtn.onclick = function() {
          if (!recognizing) {
            recognition.start();
            recognizing = true;
            micBtn.style.background = '#ff5252';
          } else {
            recognition.stop();
            recognizing = false;
            micBtn.style.background = '#eee';
          }
        };
      } else {
        micBtn.disabled = true;
        micBtn.title = 'Speech recognition not supported in this browser.';
        micIcon.innerHTML = '🚫';
      }
    })();

    // Suggestions area
    const suggestionArea = document.createElement('div');
    suggestionArea.style.display = 'flex';
    suggestionArea.style.flexWrap = 'wrap';
    suggestionArea.style.gap = '10px';
    suggestionArea.style.padding = '18px 28px 0 28px';
    suggestionArea.style.background = '#f7f9fb';
    suggestionArea.style.borderTop = '1.5px solid #e0e6ed';
    suggestionArea.style.justifyContent = 'flex-start';
    chatContainer.appendChild(suggestionArea);

    // Append to body
    document.body.appendChild(chatContainer);

    // --- Suggestion logic ---
    const suggestions = [
        'What are the best adventure travel destinations?',
        'Tips for cultural tourism in Europe?',
        'Best beaches for a vacation?',
        'Top city break ideas for 2024?',
        'Eco tourism destinations in Asia?',
        'Luxury travel tips for couples?',
        'How to plan a road trip in the USA?',
        'Backpacking essentials for beginners?'
    ];
    function getRandomSuggestions(arr, n) {
        const copy = arr.slice();
        const result = [];
        while (result.length < n && copy.length) {
            const idx = Math.floor(Math.random() * copy.length);
            result.push(copy.splice(idx, 1)[0]);
        }
        return result;
    }
    function renderSuggestions() {
        suggestionArea.innerHTML = '';
        const randomSuggestions = getRandomSuggestions(suggestions, 2);
        randomSuggestions.forEach(function(s) {
            const btn = document.createElement('button');
            btn.innerText = s;
            btn.style.background = '#fff';
            btn.style.color = '#2b90d9';
            btn.style.border = '1.5px solid #e0e6ed';
            btn.style.borderRadius = '10px';
            btn.style.padding = '8px 18px';
            btn.style.margin = '0';
            btn.style.cursor = 'pointer';
            btn.style.fontSize = '15px';
            btn.style.fontWeight = '500';
            btn.style.transition = 'background 0.18s, color 0.18s, border 0.18s';
            btn.onmouseover = function() { btn.style.background = '#2b90d9'; btn.style.color = '#fff'; btn.style.border = '1.5px solid #2b90d9'; };
            btn.onmouseout = function() { btn.style.background = '#fff'; btn.style.color = '#2b90d9'; btn.style.border = '1.5px solid #e0e6ed'; };
            btn.onclick = function() {
                input.value = s;
                input.focus();
            };
            suggestionArea.appendChild(btn);
        });
    }
    renderSuggestions();

    // Minimize logic
    let minimized = false;
    const contentElements = [messages, inputArea, suggestionArea];
    minimizeBtn.addEventListener('click', function() {
        minimized = !minimized;
        contentElements.forEach(function(el) {
            el.style.display = minimized ? 'none' : '';
        });
        minimizeBtn.innerHTML = minimized ? '&#9633;' : '&#8211;';
        minimizeBtn.title = minimized ? 'Restore' : 'Minimize';
        chatContainer.style.height = minimized ? 'auto' : '';
        chatContainer.style.maxHeight = minimized ? 'unset' : '520px';
    });

    // Send message handler
    function appendMessage(text, sender) {
        const msg = document.createElement('div');
        msg.style.margin = '10px 0';
        msg.style.padding = '10px 14px';
        msg.style.borderRadius = '10px';
        msg.style.maxWidth = '80%';
        msg.style.wordBreak = 'break-word';
        msg.style.fontSize = '15px';
        if (sender === 'user') {
            msg.style.background = '#fff';
            msg.style.alignSelf = 'flex-end';
            msg.style.marginLeft = 'auto';
            msg.style.border = '1.5px solid #e0e6ed';
            msg.style.boxShadow = '0 2px 8px rgba(43,144,217,0.07)';
        } else {
            msg.style.background = '#f7f9fb';
            msg.style.alignSelf = 'flex-start';
            msg.style.marginRight = 'auto';
            msg.style.border = '1.5px solid #e0e6ed';
            msg.style.boxShadow = '0 2px 8px rgba(43,144,217,0.06)';
        }
        msg.innerText = text;
        messages.appendChild(msg);
        messages.scrollTop = messages.scrollHeight;
    }
    function setLoading(loading) {
        if (loading) {
            sendBtn.disabled = true;
            sendBtn.innerText = '...';
        } else {
            sendBtn.disabled = false;
            sendBtn.innerText = 'Send';
        }
    }

    function sendMessage() {
        const userMsg = input.value.trim();
        if (!userMsg) return;
        appendMessage(userMsg, 'user');
        input.value = '';
        setLoading(true);
        fetch(GEMINI_API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                contents: [{ parts: [{ text: userMsg }] }]
            })
        })
        .then(res => res.json())
        .then(data => {
            setLoading(false);
            let botMsg = 'Sorry, I could not get a response.';
            if (data && data.candidates && data.candidates[0] && data.candidates[0].content && data.candidates[0].content.parts && data.candidates[0].content.parts[0].text) {
                botMsg = data.candidates[0].content.parts[0].text;
            }
            appendMessage(botMsg, 'bot');
            renderSuggestions();
        })
        .catch(() => {
            setLoading(false);
            appendMessage('Sorry, there was an error connecting to the chatbot.', 'bot');
        });
    }

    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') sendMessage();
    });
}

// Only load chatbot after DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', createChatbotBox);
} else {
    createChatbotBox();
}