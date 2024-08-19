import React, { useState } from "react";
import { ChatArea } from "../../organisms/chatarea";
import { SideBar } from "../../organisms/sidebar";
import styles from "./styles.module.css";

export const HomeTemplate: React.FC = () => {
  const [channelId, setChannelId] = useState<number>(0);

  const handleChannelId = (newChannelId: number) => {
    setChannelId(newChannelId);
  };

  return (
    <div className={styles.base}>
      <SideBar onChangeId={handleChannelId} />
      <ChatArea channelId={channelId} own_id={1} />
    </div>
  );
};
