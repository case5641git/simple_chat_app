import React, { useState } from "react";
import styles from "./styles.module.css";
import send_btn from "../../../images/send_btn.png";

type ChatAreaProps = {
  channelId: number;
  own_id: number;
  children?: React.ReactNode;
};

type Message = {
  id: number;
  user_id: number;
  user: {
    name: string;
  };
  channel_id: number;
  message: string;
};

export const ChatArea: React.FC<ChatAreaProps> = ({
  channelId,
  own_id,
  children,
}) => {
  const messages = [
    {
      id: 1,
      user_id: 1,
      user: {
        name: "User1",
      },
      channel_id: 1,
      message: "Hello, there!",
    },
    {
      id: 2,
      user_id: 1,
      user: {
        name: "User1",
      },
      channel_id: 1,
      message: "How are you feeling?",
    },
    {
      id: 3,
      user_id: 2,
      user: {
        name: "User2",
      },
      channel_id: 1,
      message: "Hi! I'm good !",
    },
    {
      id: 4,
      user_id: 3,
      user: {
        name: "User3",
      },
      channel_id: 2,
      message: "Hello, there!",
    },
    {
      id: 5,
      user_id: 4,
      user: {
        name: "User4",
      },
      channel_id: 3,
      message: "How are you feeling?",
    },
    {
      id: 6,
      user_id: 5,
      user: {
        name: "User5",
      },
      channel_id: 4,
      message: "Hi! I'm good !",
    },
  ];

  return (
    <section className={styles.chatAreaWrapper}>
      <div className={styles.chatAreaContainer}>
        {channelId !== 0 ? (
          <div className={styles.chatAreaInner}>
            <div className={styles.chatArea}>
              {messages.map((message: Message) => (
                <>
                  {message.channel_id === channelId ? (
                    <div
                      key={message.id}
                      className={
                        own_id === message.user_id
                          ? styles.ownMessage
                          : styles.otherMessage
                      }
                    >
                      <div className={styles.messageUser}>
                        {message.user.name}
                      </div>
                      <div className={styles.messageContent}>
                        {message.message}
                      </div>
                    </div>
                  ) : null}
                </>
              ))}
            </div>
            <div className={styles.messageForm}>
              <form action="">
                <div className={styles.messageFormInner}>
                  <input />
                  <button>
                    <img src={send_btn} alt="送信ボタン" />
                  </button>
                </div>
              </form>
            </div>
          </div>
        ) : (
          <div className={styles.chatAreaNotice}>
            <p>Please Select Channel or Chat...</p>
          </div>
        )}
      </div>
    </section>
  );
};
