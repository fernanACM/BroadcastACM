# BroadcastACM
[![](https://poggit.pmmp.io/shield.state/BroadcastACM)](https://poggit.pmmp.io/p/BroadcastACM)

[![](https://poggit.pmmp.io/shield.api/BroadcastACM)](https://poggit.pmmp.io/p/BroadcastACM)

**The best announcer for PocketMine-MP 5.0 servers, make messages for your users very easily.
Make the best announcements for your server without any difficulty when making them, only with UI it will serve you**

![Captura de pantalla 2023-06-03 213457](https://github.com/fernanACM/BroadcastACM/assets/83558341/afd46959-2c8e-42e9-b8d7-deb167838016)

<a href="https://discord.gg/YyE9XFckqb"><img src="https://img.shields.io/discord/837701868649709568?label=discord&color=7289DA&logo=discord" alt="Discord" /></a>

### 💡 Implementations
* [x] Images > *To load the images, use [FormImagesFIX](https://poggit.pmmp.io/r/146450/FormImagesFix_dev-14.phar)*
* [X] Configuration
* [x] Sounds.
* [x] Message customization.
* [X] Commands.
* [x] Keys in the form.
---

### 🔑 Keys in the form
**This is for the purpose of writing comfortably; Use the following keys for greater comfort:**
```
  - {LINE} => "\n" -> This counts as one space
  - & => "§" -> Color code
  - {PLAYER} => Player name
  - {WORLD_NAME} => World name
  - {HEALTH} => Player health
  - {MAX_HEALTH} => Player max health
  - {FOOD} => Player hunger
  - {MAX_FOOD} => Player max hunger
  - {ONLINE} => Connected players 
  - {MAX_ONLINE} => Player slots
```
**Example:**

![Captura de pantalla 2022-05-16 190044](https://user-images.githubusercontent.com/83558341/168701084-b6ccabf2-2bf4-466e-b08d-84d4a78bf8ba.png)

### 💾 Config
```yml
#   ____                               _                        _        _       ____   __  __ 
#  | __ )   _ __    ___     __ _    __| |   ___    __ _   ___  | |_     / \     / ___| |  \/  |
#  |  _ \  | '__|  / _ \   / _` |  / _` |  / __|  / _` | / __| | __|   / _ \   | |     | |\/| |
#  | |_) | | |    | (_) | | (_| | | (_| | | (__  | (_| | \__ \ | |_   / ___ \  | |___  | |  | |
#  |____/  |_|     \___/   \__,_|  \__,_|  \___|  \__,_| |___/  \__| /_/   \_\  \____| |_|  |_|
#        by fernanACM

# The best announcer for PocketMine-MP 4.0 servers, make messages for your users very easily.
# Customize or disable the sound to the Broadcast, The page for the sounds is here: 
# https://www.digminecraft.com/lists/sound_list_pe.php

# DO NOT TOUCH!
config-version: 1.0.0
# PREFIX
Prefix: "&l&f[&6BroadcastACM&f]&7»&r "
# Use "true" or "false" to enable/disable broadcast
Broadcast: true
# The message production delay, default is '300' => 300 seconds
Broadcast-delay: 300
# Broadcast message mode
BroadcastMode:
  # Available message modes:
  # - MESSAGE => Player chat message 
  # - TOAST => Player notification bar
  mode: "MESSAGE"
  # Sound list:
  # https://www.digminecraft.com/lists/sound_list_pe.php
  soundName: "random.pop2"
  # Use "true" or "false" to enable/disable this option
  sound: true
# Broadcast messages here, you can use the following 'keys' to improve the messages. 
#                 [NOTE] 
# Follow the Broadcast pattern to avoid possible errors.
# =======(KEYS)=======
# & => §
# {LINE} => "\n"
# {PLAYER} => Player's name
# {PING} => Player ping
# {ONLINE} => Connected players
# {MAX_ONLINE} => Player slots
# {WORLD_NAME} => World name
# {TPS} => Server heartbeat
Messages:
  - "&eHey &a{PLAYER}&e, thanks for using BroadcastACM"
  - "&eVisit my discord server: &bhttps://discord.gg/YyE9XFckqb"
  - "&eRight now there are &a{ONLINE}&5/&c{MAX_ONLINE}&e people connected to the server"
  - "&eHi &a{PLAYER}&e, your ping &d{PING} &eis amazing :o"
  - "&eYou are in &6{WORLD_NAME}"
  - "&eYour server has heartbeats of &a{TPS}"
```
### 🕹 Commands
| Command | Description |
|---------|-------------|
| ```/broadcastacm``` | Open the main menu |
| ```/broadcastacm help``` | Command list |
| ```/broadcastacm title``` | Title and subTitle |
| ```/broadcastacm toast``` | Toast |
| ```/broadcastacm tip``` | Tip |
| ```/broadcastacm actionbar``` | ActionBar |
| ```/broadcastacm popup``` | Popup |
| ```/broadcastacm message``` | Message |

### 🔒 Permissions
| Permission | Description |
|---------|-------------|
| ```broadcastacm.cmd.acm``` | Executing the command |
| ```broadcastacm.help.acm``` | Command list |
| ```broadcastacm.message.acm``` | Message |
| ```broadcastacm.title.acm``` | Title |
| ```broadcastacm.tip.acm``` | Tip |
| ```broadcastacm.actionbar.acm``` | ActionBar |
| ```broadcastacm.toast.acm``` | Toast |
| ```broadcastacm.popup.acm``` | Popup |

### 📞 Contact 

| Redes | Tag | Link |
|-------|-------------|------|
| YouTube | fernanACM | [YouTube](https://www.youtube.com/channel/UC-M5iTrCItYQBg5GMuX5ySw) | 
| Discord | fernanACM#5078 | [Discord](https://discord.gg/YyE9XFckqb) |
| GitHub | fernanACM | [GitHub](https://github.com/fernanACM)
| Poggit | fernanACM | [Poggit](https://poggit.pmmp.io/ci/fernanACM)
****

### ✔ Credits
| Authors | Github | Lib |
|---------|--------|-----|
| Vecnavium | [Vecnavium](https://github.com/Vecnavium) | [FormsUI](https://github.com/Vecnavium/FormsUI/tree/master/) |
| CortexPE | [CortexPE](https://github.com/CortexPE) | [Commando](https://github.com/CortexPE/Commando/tree/master/) |
| Muqsit | [Muqsit](https://github.com/Muqsit) | [SimplePacketHandler](https://github.com/Muqsit/SimplePacketHandler) |
| DaPigGuy | [DaPigGuy](https://github.com/DaPigGuy) | [libPiggyUpdateChecker](https://github.com/DaPigGuy/libPiggyUpdateChecker) |
****
