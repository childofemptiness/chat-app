import { useEffect, useState } from "react";

const ChatList = ({  }) => {

    const [chats, setChats] = useState([]);

    useEffect(() => {

        fetch('/chats', {

            method: 'GET',
            headers: {
                
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {

            console.log(data.chats);

            setChats(data.chats);
        });
    }, []);

    return (
        <div>
          <h2>Список чатов</h2>
          <ul>
            {chats.map((chat, index) => (
              <li key={index}>{chat}</li>
            ))}
          </ul>
        </div>
      );
    };

export default ChatList;