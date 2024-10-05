import React, { useEffect, useState } from "react";
import '../bootstrap';
import echo from "../bootstrap";
import pusher from "../bootstrap";

const Message = React.memo(({ chatId }) => {

    const [messages, setMessages] = useState([]);

    const [input, setInput] = useState('');
  
    const csrfToken = document

      .querySelector('meta[name="csrf-token"]')
    
      .getAttribute('content');
  
    useEffect(() => {

      // if (!echo) {

      //   console.error('Echo не инициализирован');

      //   return;
      // }
  
      // const channel = echo.channel('chat-app');

      // channel.error(function () {

      //   console.log('Error');
      // });
  
      // channel.listen('.MessageEvent', (e) => {

      //   console.log('Новое сообщение: ', e.message.content);

      //   setMessages((prevMessages) => [...prevMessages, e.message]);

      // });

      if (!pusher) {

        console.error('Pusher не инициализирован!');

        return;
      }
    

      const channel = pusher.subscribe('chat-app');

      
      channel.bind('pusher:subscription_succeeded', () => {
        
        console.log('Подписка на канал успешна');
      });

      console.log('- - -');

      console.log(pusher.allChannels());

      console.log('- - -');

      // Слушатель события
      channel.bind('MessageEvent', function() {
        
        // console.log('Новое сообщение: ', data.message.content);

        console.log(555);
        
        // setMessages((prevMessages) => [...prevMessages, data.message]);
      });

  
      const fetchMessages = async () => {

        try {

          const response = await fetch('/messages', {

            method: 'GET',

            headers: {

              'Content-Type': 'application/json',

              'X-CSRF-TOKEN': csrfToken,
            },
          });

          const data = await response.json();

          setMessages(data);

        } catch (error) {

          console.error('Ошибка при получении сообщений: ', error);
        }
      };
  
      fetchMessages();
  
      return () => {

        echo.leaveChannel('chat-app');
      };

    }, [csrfToken, echo]);

    // Запрос для отправки сообщения на сервер

    const sendMessage = (e) => {

        e.preventDefault();

        const newMessage = input.trim();

        console.log(newMessage);

        if (newMessage) {

            fetch('/messages', {

                method: 'POST',

                headers: {

                    'Content-Type': 'application/json',

                    'X-CSRF-TOKEN': csrfToken,
                },

                body: JSON.stringify({ 
                    
                    message: newMessage,

                    chatId: chatId,
                 }),

            }).then(response => response.json())

              .then(data => {
                
                  setInput(''); // Очистка поля ввода

                  console.log(data);
              });
        }
    };

    // Возвращаем страницу

    return (

        <div className="bg-gray-900 rounded-lg p-6 max-w-lg mx-auto flex flex-col" style={{ height: '80vh' }}>
        
            <h2 className="text-3xl mb-6 text-blue-400">Чат № {chatId}</h2>
            
            <ul className="overflow-y-auto bg-gray-800 rounded-lg p-4 flex-grow mb-4">
                {messages.length > 0 ? (
                    messages.map((msg) => (
                    <li key={msg.id} className="text-white mb-2">
                        <strong>{msg.user?.name || 'Неизвестный пользователь'}:</strong> {msg.content}
                    </li>
                    ))
                ) : (
                    <li className="text-center text-gray-500">No messages yet</li>
                )}
            </ul>
            
            <form onSubmit={sendMessage} className="flex items-center space-x-8">
  
                <input
                    type="text"
                    value={input}
                    onChange={(e) => setInput(e.target.value)}
                    className="flex-grow p-3 bg-gray-700 rounded-full focus:outline-none text-white placeholder-gray-400"
                    placeholder="Type your message..."
                />

                <button
                    type="submit"
                    className="bg-blue-600 text-white p-4 rounded-full transition duration-200 hover:bg-blue-700 hover:shadow-[0_0_10px_0_rgba(0,115,255,0.8),0_0_30px_0_rgba(0,115,255,0.6)]"
                >
                    Отправить
                </button>

            </form>
        
        </div>
    );

});

export default Message;

